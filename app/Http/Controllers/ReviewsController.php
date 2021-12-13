<?php

namespace App\Http\Controllers;

use App\Models\Deals;
use App\Models\Listing;
use App\Models\Offers;
use Illuminate\Http\Request;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    public function index($user_id){
        $user = User::find($user_id);
        $reviews = Reviews::with('owner')->where('given_to',$user->id)->orderBy('id','DESC')->paginate(10);
        return response()->json([
            'reviews' => $reviews
        ],200);
    }
    public function review_meta($user_id){
        
        $user = User::find($user_id);
        $data['avg_rating'] = DB::table('reviews')->where('given_to',$user->id)->avg('rating');
        $data['avg_rating']==null ? 0 : $data['avg_rating'];
        $data['total_reviews'] =DB::table('reviews')->where('given_to',$user->id)->count();
        return response()->json([
            'data' => $data
        ],200);
    }
    public function store(Request $request){
        $deal = $request->deal_id;
        $deal = Deals::findOrFail($deal);
        $listing = Listing::findOrFail($deal->listing_id);
        $offer = Offers::findOrFail($deal->offer_id);
        $given_by = auth()->user()->id;
        $gievn_to = 0;
        if(auth()->user()->id==$listing->posted_by){
            $given_to = $offer->posted_by;
        }
        else{
            $given_to = $listing->posted_by;
        }
        $review = Reviews::create([
            'deal_id' => $deal->id,
            'given_by' => $given_by,
            'given_to' => $given_to,
            'rating' => $request->rating,
            'feedback' => $request->feedback
        ]);
        return back();
    }
}
