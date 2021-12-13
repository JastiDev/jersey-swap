<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;

class ADListingManager extends Controller
{
    public function index(){
        $listings = Listing::all();
        return view('admin.listings.all',['listings'=>$listings]);
    }
}
