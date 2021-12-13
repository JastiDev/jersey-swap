<?php

namespace App\Http\Controllers;

use App\Models\DealTracking;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Deals;

class DealTrackingController extends Controller
{
    public function index($id){
        $deal = Deals::where('listing_id',$id)->first();
        $deal_tracking = DealTracking::where('deal_id',$deal->id)->get();
        return response()->json([
            'tracking' => $deal_tracking
        ],200);
    }
}
