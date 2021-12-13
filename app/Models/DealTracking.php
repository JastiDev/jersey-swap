<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealTracking extends Model
{
    use HasFactory;
    protected $table="deal_tracking";
    protected $fillable=[
        'deal_id',
        'title',
        'message'
    ];
}
