<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Credits;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Billable, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'f_name',
        'l_name',
        'username',
        'email',
        'role_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role(){
        return $this->hasOne(Roles::class,'id','role_id');
    }
    public function credit(){
        return $this->hasOne(Credits::class,'user_id','id');
    }
    public function creditInNumber(){
        $data =  Credits::where('user_id',$this->id)->first();
        if($data==null){
            return 0;
        }
        return $data->credit;
    }
    public function hasAnyWithdrawlRequest(){
        $credit_request = CreditRequest::where([
            'user_id' => auth()->user()->id,
            'status' => 'progress'
        ])->count();
        if($credit_request>0){
            return true;
        }
        return false;
    }
}
