<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferGallery extends Model
{
    use HasFactory;
    protected $table ="offers_gallery";
    protected $fillable=[
        'offer_id',
        'image'
    ];
}
