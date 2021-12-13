<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\ListingGallery;

class ExchangeController extends Controller
{
  public function index(){
    $listing = Listing::where('status','posted')->orderBy('id','DESC')->get();
    return view('frontend.pages.exchange',[
        'listing' => $listing
    ]);
  }

  public function filtered(Request $request){
    $listing;
    if(($request->category == null || $request->keyword == null) 
        || ($request->category == -1 && $request->keyword == '' )){
      $listing = Listing::where('status','posted')
        ->orderBy('id','DESC')->paginate(12);
    }else{
      if($request->category == -1){
        $listing = Listing::where([
          ['status', '=', 'posted'],
          ['product_title', 'like', '%'.$request->keyword.'%'],
        ])->orderBy('id','DESC')->paginate(12);
      }else {
        if($request->keyword == ''){
          $listing = Listing::where([
            ['status', '=', 'posted'],
            ['category', '=', $request->category],
          ])->orderBy('id','DESC')->paginate(12);
        } else {
          $listing = Listing::where([
            ['status', '=', 'posted'],
            ['category', '=', $request->category],
            ['product_title', 'like', '%'.$request->keyword.'%'],
          ])->orderBy('id','DESC')->paginate(12);
        }
      }
    }
    return response()->json($listing);
    // return view('frontend.pages.exchange',[
    //     'listing' => $listing
    // ]);
  }

  public function view($slug){
    $listing = Listing::where('slug',$slug)->first();
    $listing_gallery = ListingGallery::where('listing_id',$listing->id)->get();
    return view('frontend.pages.single-exchange',[
        'listing' =>$listing,
        'listing_gallery' =>$listing_gallery
    ]);
  }
}