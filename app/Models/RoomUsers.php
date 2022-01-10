<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomUsers extends Model
{
    use HasFactory;
    protected $table ="room_users";
    protected $fillable = ['room_id', 'user_id'];
}
