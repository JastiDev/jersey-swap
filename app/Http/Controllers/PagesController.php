<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacts;
use App\Models\Settings;
use App\Models\Testimonials;
use App\Models\Listing;
use App\Models\User;
use App\Notifications\ContactNotification;
use Throwable;

class PagesController extends Controller
{
    public function home(){
        $banner = Settings::where('setting_name','site_banner')->first();
        $banner_url = Settings::where('setting_name','site_banner_link')->first();
        $testimonials = Testimonials::orderBy('id','DESC')->get();
        $listings = Listing::where('status','posted')->orderBy('id','DESC')->take(6)->get();
        return view('frontend.pages.home',[
            'banner' => $banner,
            'banner_url' => $banner_url,
            'testimonials' => $testimonials,
            'listings' => $listings
        ]);
    }

    public function about(){
        $testimonials = Testimonials::orderBy('id','DESC')->get();
        return view('frontend.pages.about',[
            'testimonials' => $testimonials
        ]);
    }

    public function faq(){
        return view('frontend.pages.faq');
    }

    public function contact(){
        return view('frontend.pages.contact');
    }
    public function contact_post(Request $request){
        $contact = Contacts::create($request->all());
        try {
            $user = User::where('username','admin')->first();
            $data = [
                'type' => 'contact',
                'name' => $request->full_name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'url' => null,
                'url_text' => null
            ];
            $user->notify(new ContactNotification($data));
        }catch (Throwable $e) {
            report($e);
        }
        if($contact){
            return response()->json(['success'=>'Data is successfully added']);
        }
        return response()->json(['success'=>'Data is successfully added'],404);
    }
    public function termsConditions(){
        return view('frontend.pages.legal.term-condition');
    }
    public function termsofService(){
        return view('frontend.pages.legal.terms-of-service');
    }
}
