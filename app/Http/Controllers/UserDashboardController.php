<?php

namespace App\Http\Controllers;

use App\Models\Credits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $credits = Credits::where('user_id',$user->id)->first();
        $user->credits = $credits!=null && $credits->credit!=null ? $credits->credit : 0 ;
        return view('frontend.pages.users.dashboard',[
            "user" => $user
        ]);
    }
    public function settings(){
        $type = "account";
        $user =  Auth::user();
        return view('frontend.pages.users.settings',["type"=>$type,"user"=>$user]);
    }
    public function security(){
        $type = "security";
        return view('frontend.pages.users.settings',["type"=>$type]);
    }
    public function user($username){
        $user = User::where('username',$username)->first();
        if($user==null){
            abort(404);
        }
        if($user->role->role=="admin"){
            abort(404);
        }
        return view('frontend.pages.users.profile',[
            'user' => $user
        ]);
    }
    public function change_password(Request $request){
        $user = Auth::user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required | min:8 | max:20'
        ]);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password  = Hash::make($request->new_password);
            $user->save();
        }
        return back()->with('success','Password changed successfully!');
    }
    public function update_account(Request $request){
        $user =  Auth::user();
        $user->f_name = trim($request->input('f_name'));
        $user->l_name = trim($request->input('l_name'));
        // $user->tag_line = trim($request->input('tagline'));
        $user->phone = trim($request->input('phone'));
        $user->postcode = trim($request->input('postcode'));
        $user->address = trim($request->input('address'));
        $user->about = trim($request->input('about'));
        $user->save();
        return redirect('users/settings/account')->with('success','Profile info updated successfully!');
    }
    public function profile_photo(){
        $type = "profile-photo";
        return view('frontend.pages.users.settings',[
            'type' =>$type
        ]);
    }
    public function update_profile_photo(Request $request){
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        $imageName = time().'.'.$request->avatar->extension();  

        $request->avatar->move(public_path('images'), $imageName);
        
        $path = "images/".$imageName;

        $user->profile_picture = $path;

        $user->save();

        /* Store $imageName name in DATABASE from HERE */

    

        return back()
            ->with('success','You have successfully updated the profile photo!')
            ->with('avatar',$imageName); 
    }
}
