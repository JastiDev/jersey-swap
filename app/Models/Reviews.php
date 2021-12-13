<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    
    protected $table="reviews";

    protected $fillable=[
        'deal_id',
        'given_by',
        'given_to',
        'rating',
        'feedback'
    ];
    public function owner()
    {
        return $this->hasOne(User::class,'id','given_by');
    }
    public function avatar(){
        $user = $this->given_by;
        $user = User::find($user);
        return $user->profile_picture;
    }
    public function given_by_username(){
        $user = $this->given_by;
        $user = User::find($user);
        return $user->username;
    }
}
