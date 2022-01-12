<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offers;
use App\Models\OfferGallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Listing;
use App\Models\Deals;
use App\Models\User;
use Illuminate\Support\Str;
use App\Notifications\OfferNotification;
use Throwable;

class OffersController extends Controller
{
    public function index(){
        return view('frontend.pages.offers.all');
    }
    public function store(Request $request){
        $request->validate([
            'listing_id' => 'required',
            'amount' => 'required'
        ]);
        $user_id = Auth::id();
        $offer;
        if($request->isBuy== true)
            $offer = Offers::create([
                'listing_id' => $request->listing_id,
                'offer_price' => $request->amount,
                'posted_by' =>$user_id,
                'offer_status' =>'buyRequest'
            ]);
        else 
            $offer = Offers::create([
                'listing_id' => $request->listing_id,
                'offer_price' => $request->amount,
                'posted_by' =>$user_id
            ]);
        $this->upload_gallery_images($request,$offer->id);
        
        $listingBy = Listing::findOrFail($request->listing_id);
        $user = User::findOrFail($listingBy->posted_by);
        $data = [
            'type'=> 'recieved',
            'message' => Auth::user()->username.' has created an offer on your listing!',
            'image_url' => url('/'.$listingBy->product_img),
            'url' => url('listing/'.$listingBy->slug),
            'url_text' => 'Go to listing'
        ];
        try {
            $user->notify(new OfferNotification($data));
        }catch (Throwable $e) {
            report($e);
        }
        $data = [
            'type'=> 'sent',
            'message' => 'Success! Offer has been made!',
            'image_url' => url('/'.$listingBy->product_img),
            'url' => null,
            'url_text' => null
        ];
        $user = Auth::user();
        try {
            $user->notify(new OfferNotification($data));
        }catch (Throwable $e) {
            report($e);
        }
        return back()->with('success','Offer has been made!');
    }
    private function upload_gallery_images(Request $request,$offer_id=null){
        if($request->has('image') && $offer_id!==null){
            $images = $request->image;
            foreach($images as $image){
                $base64_image = $image; // your base64 encoded     
                @list($type, $file_data) = explode(';', $base64_image);
                @list(, $file_data) = explode(',', $file_data); 
                $imageName = time().Str::random(10).'.'.'png'; 
                Storage::disk('public')->put('offers/'.$imageName, base64_decode($file_data));
                OfferGallery::create([
                    'offer_id' =>$offer_id,
                    'image'=> $imageName
                ]);
            }
        }
    }
    public function get_offers($id){
        $listing = Listing::find($id);
        $offers = null;
        $makePayment = false;
        // If listing owner has accepted any offer
        if($listing->status==="closed"){
            $offers = [];
            // Get the deal details
            $offer= Deals::where('listing_id',$id)->first();
            // Now you have to find the offer
            $offer = Offers::find($offer->offer_id);
            $user = User::find($offer->posted_by);
            $offer->username = $user->username;
            $offer->user_profile_picture =  url('/')."/".$user->profile_picture;
            $offer->gallery = OfferGallery::where('offer_id',$offer->id)->get();
            $offer->description="Jersey Swap Offer!";
            $offers[]=$offer;
            $deal = Deals::where('offer_id',$offer->id)->first();
            $user = Auth::id();
            if($user!=$listing->posted_by){
                if(!$deal->offerMaker_paid){
                    $makePayment = true;
                }
            }
        }
        else{
            $offers = Offers::where(function($query) {
                $query->where('offer_status', 'posted')
                    ->orWhere('offer_status' , 'buyRequest');
            })
            ->where('listing_id', $id)
            ->get();
            $i=0;
            while($i<count($offers)){
                $user = User::find($offers[$i]->posted_by);
                $offers[$i]->username = $user->username;
                $offers[$i]->user_profile_picture = url('/')."/".$user->profile_picture;
                $offers[$i]->gallery = OfferGallery::where('offer_id',$offers[$i]->id)->get();
                $offers[$i]->description="Jersey Swap Offer!";
                $offers[$i]->offer_status=$offers[$i]->offer_status;
                $i++;
            }
        }
        return response()->json([
            'response' => $offers,
            'makePayment' => $makePayment
        ],200);
    }
    public function get_by_status(Request $request){
        $user_id = Auth::id();
        if($request->status=='posted'){
            $offers = Offers::where(function($query) {
                $query->where('offer_status', 'posted')
                    ->orWhere('offer_status' , 'buyRequest');
            })
            ->where('posted_by', $user_id)
            ->orderBy('id','DESC')
            ->get();
        }else {
            $offers = Offers::where(['posted_by'=>$user_id, 'offer_status'=>$request->status])->orderBy('id','DESC')->get();
        }
        
        $i=0;
        while($i<count($offers)){
            $listing = Listing::find($offers[$i]->listing_id);
            $offers[$i]->product_img = $listing->product_img;
            $offers[$i]->product_title = $listing->product_title;
            $user = User::findOrFail($listing->posted_by);
            $offers[$i]->username = $user->username;
            $offers[$i]->slug = $listing->slug;
            $offers[$i]->gallery = OfferGallery::where('offer_id',$offers[$i]->id)->get();
            $i++;
        }


        return response()->json([
            'offers' => $offers,
        ]);
    }
    public function decline_offer(Request $request){
        $listing_id = $request->listing;
        $offer_id = $request->offer;
        $offer = Offers::findOrFail($offer_id);
        $listing = Listing::findOrFail($listing_id);
        $offer->offer_status="cancelled";
        $offer->save();

        $user = User::findOrFail($offer->posted_by);
        $data = [
            'type'=> 'declined',
            'message' => Auth::user()->username.' has declined your offer!',
            'image_url' => url('/'.$listing->product_img),
        ];
        try {
            $user->notify(new OfferNotification($data));
        }catch (Throwable $e) {
            report($e);
        }

        return back()->with('success','Offer has been declined!');
    }
}
