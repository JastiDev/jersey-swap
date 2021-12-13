<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreditRequest;
use App\Models\Credits;
use App\Models\User;
use App\Notifications\WithdrawlNotification;
use Illuminate\Http\Request;
use Throwable;

class ADCreditRequest extends Controller
{
    public function index(){
        $credit_requests = CreditRequest::orderBy('id','DESC')->get();
        return view('admin.credit_requests.all',[
            'credit_requests' => $credit_requests
        ]);
    }
    public function withdraw(Request $request, $id){
        $credit_request = CreditRequest::findOrFail($id);
        $credit = Credits::where('user_id',$credit_request->user_id)->first();
        $credit->credit = abs($credit_request->credit -$credit->credit);
        $credit->save();
        $credit_request->status="completed";
        $credit_request->save();
        $data = [
            'type' => 'credit_request',
            'message' => 'Your withdrawal request has been accepted! Your site balance is now $'.$credit->credit.'.',
            'url' => null,
            'url_text' => null
        ];
        $user = User::find($credit_request->user_id);
        try {
            $user->notify(new WithdrawlNotification($data));
        }catch (Throwable $e) {
            report($e);
        }
        return back();
    }
    public function delete(Request $request, $id){
        $credit_request = CreditRequest::findOrFail($id);
        $credit_request->status="cancelled";
        $credit_request->save();
        $data = [
            'type' => 'credit_request',
            'message' => 'Withdrawl request has been cancelled by Jersey Swap Support Team!',
            'url' => null,
            'url_text' => null
        ];
        $user = User::find($credit_request->user_id);
        try {
            $user->notify(new WithdrawlNotification($data));
        }catch (Throwable $e) {
            report($e);
        }
        return back();
    }
}
