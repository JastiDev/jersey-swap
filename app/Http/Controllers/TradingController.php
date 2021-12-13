<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TradingController extends Controller
{
    public function index(){
        return view('frontend.pages.tradings.all');
    }
    public function get_by_status(Request $request){
        $request->validate([
            'status' => 'required'
        ]);
        $user = Auth::id();
        $listings_by_me = DB::table('listing')
                    ->leftJoin('deals','listing.id','deals.listing_id')
                    ->leftJoin('users','listing.posted_by','users.id')
                    ->leftJoin('offers','deals.offer_id','offers.id')
                    ->select('listing.*','users.username','users.f_name','users.l_name' ,'deals.created_at')
                    ->where('deals.deal_status',$request->status)
                    ->where('listing.posted_by',$user)
                    ->paginate(10);
        $listings_by_someone = DB::table('listing')
                    ->leftJoin('deals','listing.id','deals.listing_id')
                    ->leftJoin('users','listing.posted_by','users.id')
                    ->leftJoin('offers','deals.offer_id','offers.id')
                    ->select('listing.*','users.username','users.f_name','users.l_name' ,'deals.created_at')
                    ->where('deals.deal_status',$request->status)
                    ->where('offers.posted_by',$user)
                    ->paginate(10);
        if($listings_by_me->total()>0 && $listings_by_someone->total()>0){
            $listings = $listings_by_me->merge($listings_by_someone);
        }
        else if($listings_by_me->total()>0){
            $listings = $listings_by_me;
        }
        else if($listings_by_someone->total()>0){
            $listings = $listings_by_someone;
        }
        else{
            $listings = [];
        }
        return response()->json([
            'listings' => $listings
        ]);
    }
    public function get_by_user(){
        $user = Auth::user();
        $listings = DB::table('listing')
                    ->leftJoin('deals','listing.id','deals.listing_id')
                    ->leftJoin('users','listing.posted_by','users.id')
                    ->select('listing.*','users.username','users.f_name','users.l_name')
                    ->where('listing.posted_by',$user->id)
                    ->paginate(10);
        return response()->json([
            'listings' => $listings
        ]);
    }
}
