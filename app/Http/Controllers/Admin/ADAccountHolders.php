<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreditRequest;
use App\Models\Credits;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\FundsCleared;
use Throwable;

class ADAccountHolders extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.users.all',[
            'users' => $users
        ]);
    }
    public function view($id){
        $user  = User :: findOrFail($id);
        return view('admin.users.single',[
            'user' => $user
        ]);
    }
    public function delete($id){
        $user = User::findOrFail($id);
        $user->banned = 1;
        $user->save();
        return back()->with('success','User Account successfully banned!');
    }
    public function undelete($id){
        $user = User::findOrFail($id);
        $user->banned = 0;
        $user->save();
        return back()->with('success','User Account successfully banned!');
    }
    public function clearFunds($id){
        $credit_requests = CreditRequest::where('user_id',$id)->get();
        if($credit_requests!==null){
            CreditRequest::where([
                'user_id' => $id,
                'status'  => 'progress'
            ])->update([
                'status' => 'cancelled'
            ]);
        }
        $credits = Credits::where('user_id',$id)->first();
        if($credits!==null && $credits->credit>0){
            $credits->credit = 0;
            $credits->save();
            $user = User::find($id);
            $data = [
                'type' => 'fundscleared',
                'message' => $user->username.", your funds have been cleared!"
            ];
            try {
                $user->notify(new OfferNotification($data));
            }catch (Throwable $e) {
                report($e);
            }
        }
        return back()->with('success','User\'s funds have been cleared!');
    }
}
