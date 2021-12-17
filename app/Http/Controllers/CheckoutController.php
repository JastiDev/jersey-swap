<?php

namespace App\Http\Controllers;

use App\Models\Credits;
use App\Models\Deals;
use App\Models\DealTracking;
use App\Models\Escrow;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Offers;
use Stripe;
use Session;
use App\Notifications\InvoicePaid;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoices;
use App\Models\InvoicesMeta;
use App\Notifications\TrackingNotification;
use Illuminate\Support\Str;
use Throwable;

/**
 * @category   Product
 * @package    JerseySwap
 * @copyright  October 2021 Awais Ahmad & Cawoy LTD
 * @author     Awais Ahmad <info@itsahmadawais.com>
 * @author     Cawoy LTD <info@cawoy.com>
 * @version    Release: 1.0
 */
class CheckoutController extends Controller
{
    /**
     * @return the checkout page.
     */
    public function checkout(Request $request){
        $type = $request->type;
        $settings = $this->settings();
        $data = [];
        if($request->type=="offerMaker"){
            $offer = Deals::where('listing_id',$request->listing)->first();
            $offer = Offers::find($offer->offer_id);
            $settings['prices']['offer'] = $offer->offer_price;
            $data['offer'] = $offer->id;
        }
        else if($request->type=="lister")
        {
            $data['posted_by'] = $request->posted_by;
            $data['offer'] = $request->offer_id;
        }
        $data['type'] = $request->type;
        $data['listing'] = Listing::find($request->listing);
        return view('frontend.pages.checkout',[
            "prices"=>$settings['prices'],
            "data" => $data
        ]);
    }

    /**
     * @return the thank you page
     */
    public function charge(Request $request){
        //User Type
        $type = $request->type;
        $price = 0;
        $settings = $this->settings();
        $price = $settings['prices']['security'];
        $offer = Offers::findOrFail($request->offer_id);
        $listing = Listing::where('id',$offer->listing_id)->first();
        
        $user = Auth::user();
        if($request->has('enablePhone')){
            $user->phone = $request->phone;
            $user->save();
        }
        //If User Type is offerMaker
        if($type=="offerMaker"){
            $price += $offer->offer_price;
        }
        else{ // If User Type is lister

        }
        if($price>0){
            // If amount is charged successfully
            $stripeCharge = $request->user()->charge(
                intval($price * 100), $request->paymentMethodId
            );
        }
        // If User Type is lister
        if($type=="lister"){
            /**
             * Change Listing Status to closed
             * Create a deal and keep its status to  payment
             * Create an invoice for both users and notify the user 2
             */
            $listing->update([
                'status' => 'closed'
            ]); $offer->update([
                'status' => 'closed'
            ]);
            $deal_id = $this->dealMaker([
                'listing_id' => $listing->id,
                'offer_id' => $offer->id
            ]);
            $this->invoiceMaker([
                'user_id' => $user->id,
                'deal_id' => $deal_id,
                'billable_amount' => $price,
                'invoice_status' => 'paid',
                'items' => 2,
                'invoice_meta' => [
                    'Shipping Charges' => $settings['prices']['shipping'],
                    'Security Fee' =>  $settings['prices']['security'],
                    'f_name' => $request->f_name,
                    'l_name' => $request->l_name,
                    'shipping_address' => $request->shipping_address,
                    'country' => $request->country,
                    'state' => $request->state,
                    'zipcode' => $request->zipcode
                ]
            ]);
            $this->invoiceMaker([
                'user_id' => $offer->posted_by,
                'deal_id' => $deal_id,
                'billable_amount' => 0,
                'invoice_status' => 'unpaid',
                'items' => 2,
                'invoice_meta' => [
                    'Offer Price' => $offer->offer_price,
                ]
            ]);
        }
        else{ // If User Type is offerMaker
            /**
             * Change deal status to in progress
             * Update Credit
             * Change invoice status to paid 
             */
            $deal = Deals::where('offer_id',$offer->id)->first();
            $deal->offerMaker_paid = true;
            $deal->deal_status = "progress";
            $deal->save();
            

            $invoice = Invoices::where([
                'deal_id' => $deal->id,
                'user_id' => $offer->posted_by
            ])->first();
            $invoice->billable_amount = $price;
            $invoice->invoice_status="paid";
            $invoice->save();
            $this->invoiceMetaMaker($invoice->id,[
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'shipping_address' => $request->shipping_address,
                'country' => $request->country,
                'state' => $request->state,
                'zipcode' => $request->zipcode,
                'Shipping Charges' => $settings['prices']['shipping'],
                'Security Fee' =>  $settings['prices']['security'],
            ]);
            if($offer->offer_price>0){
                $escrow = Escrow::create([
                    'amount' => $offer->offer_price,
                    'deal_id' => $deal->id,
                    'given_by' => Auth::id(),
                    'given_to' => $listing->posted_by,
                    'status' => 'progress'
                ]);
            }
            DealTracking::create([
                'deal_id' => $deal->id,
                'title' => 'Trade Started!',
                'message' => 'The payment and offer amount has been paid and the trade has started.'
            ]);
            $user = User::find($listing->posted_by);
            $user_2 = User::find($offer->posted_by);
            $data = [
                'type' => 'tracking',
                'message' => 'There is a new update available for the tracking of the trade.',
                'url' => url('listing/'.$listing->slug),
                'url_text' => 'Go to Listing'
            ];
            try {
                $user->notify(new TrackingNotification($data));
                $user_2->notify(new TrackingNotification($data));
            }catch (Throwable $e) {
                report($e);
            }
        }
        $this->notificationSender([
            "listing" => $offer->listing_id,
            "offerMaker"   => $offer->posted_by
        ]);
        return redirect('thank-you')->with('thankyou','Thank You! Payment Done!');
    }
    public function thankYou(){
        if(session('thankyou','null')=="null"){
            return redirect('/');
        }
        session()->forget('thankyou');
        return view('frontend.pages.thank-you');
    }
    /**
     * @return the prices for shipping and security stores in the settings
     */
    private function settings(){
        $settings = [];
        $settings['prices']['shipping'] = $this->price("shipping");
        $settings['prices']['security'] = $this->price("security");
        $settings['prices']['offer']=0;
        return $settings;
    }

    /**
     * @return the prices
     */
    private function price($type){
        $price = 0;
        if($type=="shipping"){
            $shipping = Settings::where('setting_name','shipping_price')->first();
            if($shipping==null){
                $price=20;
            }
            else{
                $price = $shipping->setting_value;
            }
        }
        else if($type=="security"){
            $security = Settings::where('setting_name','security_fee')->first();
            if($security==null){
                $price=30;
            }
            else{
                $price = $security->setting_value;
            }
        }
        return $price;
    }

    
    private function notificationSender($data){
        $listing = Listing::where('id',$data["listing"])->first();
        $notification_text = [
            'type' => 'lister',
            'url'  => url('listing/'.$listing->slug), 'url_text' => 'Go to listing',
            'image_url'  => url('/'.$listing->product_img),
            'message' => 'You have successfully paid your invoice!'
        ];
        $user = Auth::user();
        try {
            $user->notify(new InvoicePaid($notification_text));
        }catch (Throwable $e) {
            report($e);
        }
        if($data['offerMaker']!=$user->id)
        {
            $notification_text = [
                'type' => 'offerMaker',
                'url'  => url('listing/'.$listing->slug), 'url_text' =>'Pay Invoice',
                'image_url'  => url('/'.$listing->product_img),
                'message' => $user->username." has accepted your offer. Pay your invoice to start the trade!"
            ];
            $user= User::find($data['offerMaker']);
            try {
                $user->notify(new InvoicePaid($notification_text));
            }catch (Throwable $e) {
                report($e);
            }
        }
    }


    private function invoiceMaker($data){
         $invoice  = Invoices::create($data);
         $this->invoiceMetaMaker($invoice->id,$data['invoice_meta']);
    }
    private function invoiceMetaMaker($invoice_id,$data){
        foreach($data as $key => $value){
            if($key=="Offer Price" && $value==0){
                continue;
            }
            $invoice_meta = InvoicesMeta::create([
                'invoice_id' => $invoice_id,
                'meta_key' => $key,
                'meta_value' => $value
            ]);
        }
    }
    private function dealMaker($data){
        $deal_number = Str::random(10);
        while(1){
            $temp_deal_number = Deals::where('deal_number',$deal_number)->first();
            if($temp_deal_number==null){
                break;
            }
        }
        $deal = Deals::create([
            'deal_number' => $deal_number,
            'listing_id' => $data['listing_id'],
            'offer_id' => $data['offer_id'],
            'deal_status' => 'payment',
            'lister_paid' => true,
            'offerMaker_paid' => false
        ]);
        return $deal->id;
    }
}
