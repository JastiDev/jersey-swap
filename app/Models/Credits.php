<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credits extends Model
{
    use HasFactory;
    protected $table = "credits";
    protected $fillable = [
        'user_id',
        'credit'
    ];
    static public function update_credit($data){
        $user = User::find($data['user_id']);
        $credit = Credits::where('user_id',$user->id)->first();
        if($credit==null){
            $credit = Credits::create($data);
        }
        $credit->credit = $data['credit'];
        $credit->save();
        return $credit;
    }
}
