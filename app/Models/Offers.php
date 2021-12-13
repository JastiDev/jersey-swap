<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    use HasFactory;
    protected $table ="offers";
    protected $fillable=[
        'listing_id',
        'posted_by',
        'offer_status',
        'offer_price'
    ];
    public function gallery()
    {
        return $this->hasMany(OfferGallery::class,'offer_id','id');
    }
    public function owner()
    {
        return $this->hasOne(User::class,'id','posted_by');
    }
}
