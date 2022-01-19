<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;

class ADSettings extends Controller
{
    public function index(){
        $settings['prices']['shipping'] = Settings::where('setting_name','shipping_price')->first();
        $settings['prices']['security'] = Settings::where('setting_name','security_fee')->first();
        $settings['banner'] = Settings::where('setting_name','site_banner')->first();
        $settings['banner_link'] = Settings::where('setting_name','site_banner_link')->first();
        return view('admin.settings.all',[
            'settings' => $settings
        ]);
    }
    public function update_prices(Request $request){
        $request->validate([
            'shipping' => ['required','integer','min:1'],
            'security' => ['required','integer','min:1']
        ]);

        $shipping = Settings::where('setting_name','shipping_price')->first();
        if( $shipping==null){
            $shipping = new Settings();
            $shipping->setting_name = 'shipping_price';
        }
        $shipping->setting_value=$request->shipping;
        $shipping->save();

        $security = Settings::where('setting_name','security_fee')->first();
        if( $security==null){
            $security = new Settings();
            $security->setting_name = 'security_fee';
        }
        $security->setting_value=$request->security;
        $security->save();

        return back()->with('success-prices','Pricing has been updated!');
    }
    public function update_banner(Request $request){
        $request->validate([
            'banner' => 'required|image|mimes:jpeg,png,jpg|max:15360',
            'link' => 'required'
        ]);
        $banner = Settings::where('setting_name','site_banner')->first();
        $banner_link = Settings::where('setting_name','site_banner_link')->first();
        if($banner==null){
            $banner = new Settings();
            $banner->setting_name="site_banner";
        }
        if($banner_link==null){
            $banner_link = new Settings();
            $banner_link->setting_name = 'site_banner_link';
        }
        else{
            @unlink($banner_link->setting_value);
        }
        $imageName = time().'.'.$request->banner->extension();
        $request->banner->move(storage_path('app/public/banner'), $imageName);
        $banner->setting_value =  $imageName;
        $banner_link->setting_value = $request->link; $banner_link->save();
        $banner->save();

        return back()->with('success-banner','Banner has been updated!');
    }
}
