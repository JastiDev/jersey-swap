<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelsDealTracking;
use App\Models\Credits;
use Illuminate\Http\Request;
use App\Models\Deals;
use App\Models\DealTracking;
use App\Models\Escrow;
use App\Models\Invoices;
use App\Models\InvoicesMeta;
use App\Models\Listing;
use App\Models\ListingGallery;
use App\Models\OfferGallery;
use App\Models\Offers;
use App\Models\User;
use App\Notifications\DealNotification;
use App\Notifications\EscrowNotification;
use App\Notifications\TrackingNotification;
use Throwable;

class ADDeals extends Controller
{
    public function index(){
        $deals = null;
        if(isset($_GET['type'])){
            $type = $_GET['type'];
            $deals = Deals::where('deal_status',$type)->orderBy('id','DESC')->get();
        }
        else
        {
            $deals = Deals::orderBy('id')->get();
        }
        return view('admin.deals.all',[
            'deals' => $deals
        ]);
    }
    public function edit($id){
        $deal = Deals::findOrFail($id);
        $listing = Listing::findOrFail($deal->listing_id);
        $listing_gallery = ListingGallery::where('listing_id',$listing->id)->get();
        $offer = Offers::findOrFail($deal->offer_id);
        $offer_gallery = OfferGallery::where('offer_id',$offer->id)->get();
        $list_maker_invoice = Invoices::where('deal_id',$deal->id)->where('user_id',$listing->posted_by)->first();
        $offer_maker_invoice = Invoices::where('deal_id',$deal->id)->where('user_id',$offer->posted_by)->first();
        $deal_tracking = DealTracking::where('deal_id',$deal->id)->get();
        
        return view('admin.deals.single',[
            'deal' => $deal,
            'listing' => $listing,
            'listing_gallery' => $listing_gallery,
            'offer' => $offer,
            'offer_gallery' => $offer_gallery,
            'list_maker_invoice' => $list_maker_invoice,
            'offer_maker_invoice' => $offer_maker_invoice,
            'deal_tracking' => $deal_tracking
        ]);
    }
    public function update($id){
        $deal = Deals::findOrFail($id);
        $deal->deal_status="completed";
        $deal->save();
        $listing = Listing::findOrFail($deal->listing->id);
        $offer = Offers::findOrFail($deal->offer_id);
        $escrow = Escrow::where([
            'deal_id' => $deal->id,
            'status' => 'progress'
        ])->first();
        if($escrow!==null){
            $escrow->status="completed";
            $escrow->save();
            $this->addCredit($escrow->given_to,$escrow->amount);
        }
        $user = $listing->owner;
        $user_2 = $offer->owner;
        $data = [
            'type' => 'completed',
            'message' => 'Hooray! Your trading status has been changed to completed. You can leave your feedback now!',
            'url' => url('listing/'.$listing->slug),
            'url_text' => 'Give Feedback',
            'url' => url('listing/'.$listing->product_img)
        ];
        try {
            $user->notify(new DealNotification($data));
            $user_2->notify(new DealNotification($data));
        }catch (Throwable $e) {
            report($e);
        }
        if($offer->offer_price>0){
            $data = [
                'type' => 'escrow',
                'message' => 'You just recieved an amount of $'.$offer->offer_price.' from your last trading!',
                'url' => url('users/'.$user->username.'/dashboard'),
                'url_text' => 'Go to Dashboard'
            ];
            try {
                $user->notify(new EscrowNotification($data));
            }catch (Throwable $e) {
                report($e);
            }
        }
        return back();
    }
    public function tracking(Request $request, $id){
        DealTracking::create($request->all());
        $deal = Deals::findOrFail($id);
        $listing = Listing::findOrFail($deal->listing_id);
        $offer = Offers::findOrFail($deal->offer_id);
        $user = User::find($listing->posted_by);
        $user_2 = User::find($offer->posted_by);
        $data = [
            'type' => 'tracking',
            'message' => 'There is a new update available for the tracking of the trade.',
            'url' => url('listing/'.$listing->slug),
            'url_text' => 'Go to Listing',
            'image_url' => url('listing/'.$listing->product_img)
        ];
        try {
            $user->notify(new TrackingNotification($data));
            $user_2->notify(new TrackingNotification($data));
        }catch (Throwable $e) {
            report($e);
        }
        return redirect('admin/deal/'.$id);
    }
    public function delete($id){
        $deal = Deals::findOrFail($id);
        $deal->deal_status="cancelled";
        $deal->save();
        $listing = Listing::findOrFail($deal->listing->id);
        $offer = Offers::findOrFail($deal->offer_id);
        $user = $listing->owner;
        $user_2 = $offer->owner;
        /**
         * ### Do not return any security or shipping fee to the customer.
         * $this->refundBack($deal->id,$user->id,$user_2->id);
         * */
        $escrow = Escrow::where([
            'deal_id' => $deal->id,
            'status' => 'progress'
        ])->first();
        if($escrow!==null){
            $credit = Credits::Where('user_id',$escrow->given_by)->first();
            if($credit!==null){
                $credit->credit = $credit->credit + $escrow->amount;
                $credit->save();
            }
            else{
                $credit = Credits::create([
                    'credit' => $escrow->amount,
                    'user_id' => $escrow->given_by
                ]);
            }
            $escrow->status="cancelled";
            $escrow->save();
        }
        $data = [
            'type' => 'cancelled',
            'message' => 'Your trading status has been cancelled by the Jersey Swap Team!',
            'url' => url('listing/'.$listing->slug),
            'url_text' => 'Go to Listing',
            'url' => url('listing/'.$listing->product_img)
        ];
        try {
            $user->notify(new DealNotification($data));
            $user_2->notify(new DealNotification($data));
        }catch (Throwable $e) {
            report($e);
        }
        return redirect('/admin/deal/'.$deal->id)->with('success','Deal cancelled!');
    }
    private function refundBack($deal_id,$user_1,$user_2){
        
        $invoice = Invoices::where([
            'deal_id' => $deal_id,
            'user_id' => $user_1
        ])->first();
        if($invoice->invoice_status=="paid"){
            $shipping = InvoicesMeta::where([
                'invoice_id' => $invoice->id,
                'meta_key' => 'Shipping Charges'
            ])->first();
            $security = InvoicesMeta::where([
                'invoice_id' => $invoice->id,
                'meta_key' => 'Security Fee'
            ])->first();
            $refund_amount = $shipping->meta_value + $security->meta_value;
            $this->addCredit($user_1,$refund_amount);
        }
        $invoice_2 = Invoices::where([
            'deal_id' => $deal_id,
            'user_id' => $user_2
        ])->first();
        if($invoice_2->invoice_status=="paid"){
            $shipping = InvoicesMeta::where([
                'invoice_id' => $invoice->id,
                'meta_key' => 'Shipping Charges'
            ])->first();
            $security = InvoicesMeta::where([
                'invoice_id' => $invoice->id,
                'meta_key' => 'Security Fee'
            ])->first();
            $refund_amount = $shipping->meta_value + $security->meta_value;
            $this->addCredit($user_2,$refund_amount);
        }
    }
    private function addCredit($user_id,$credit){
        $credits_user = Credits::where('user_id',$user_id)->first();
        if($credits_user==null){
            $credits_user = Credits::create([
                'user_id' => $user_id
            ]);
            $credits_user->user_id = $user_id;
        }
        $credits_user->credit = $credits_user->credit + $credit;
        $credits_user->save();
    }
}
