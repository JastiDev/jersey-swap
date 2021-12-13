<?php

namespace App\Http\Controllers;

use App\Models\CreditRequest;
use App\Models\Credits;
use App\Notifications\WithdrawlNotification;
use Illuminate\Http\Request;
use Throwable;

class CreditRequestController extends Controller
{
    public function create()
    {
        $credit = Credits::where('user_id',auth()->user()->id)->first();
        $data = [
            'type' => 'credit_request',
            'message' => '',
            'url' => null,
            'url_text' => null
        ];
        if($credit!==null){
            $credit_request = CreditRequest::create([
                'user_id' => auth()->user()->id,
                'credit' => $credit->credit
            ]);
            $data['message'] = 'Withdrawl request has been generated! Jersey Swap team will contact you soon!';
        }
        else{
            $data['message'] = 'Error in generating the withdrawl request!';
        }
        try {
            auth()->user()->notify(new WithdrawlNotification($data));
        }catch (Throwable $e) {
            report($e);
        }
        return back();
    }

}
