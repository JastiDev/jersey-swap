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
        $listings = DB::table('listing')
                    ->leftJoin('deals','listing.id','deals.listing_id')
                    ->leftJoin('users','listing.posted_by','users.id')
                    ->leftJoin('offers','deals.offer_id','offers.id')
                    ->select('listing.*','users.username','users.f_name','users.l_name' ,'deals.created_at')
                    ->where(function($query) use ($user) {
                        $query->where('listing.posted_by',$user)
                            ->orWhere('offers.posted_by',$user);
                    })
                    ->where('deals.deal_status',$request->status)
                    ->orderBy('deals.id','DESC')
                    ->get();
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
