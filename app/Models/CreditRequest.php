<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditRequest extends Model
{
    use HasFactory;
    protected $table = "credit_request";
    protected $fillable = [
        'user_id',
        'credit'
    ];
    public function owner(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
