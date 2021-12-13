<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingGallery extends Model
{
    use HasFactory;
    protected $table = "listing_gallery";
    protected $fillable=[
        'listing_id',
        'image'
    ];
    public $timestamps = false;
}
