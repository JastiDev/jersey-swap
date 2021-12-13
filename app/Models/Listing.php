<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Offers;
class Listing extends Model
{
    use HasFactory;
    protected $table="listing";
    protected $fillable = [
        'product_title',
        'product_description',
        'product_img',
        'posted_by',
        'slug',
        'status',
        'authentic',
        'category'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'posted_by');
    }
    public function owner()
    {
        return $this->hasOne(User::class,'id','posted_by');
    }
    public function listingOffers(){
        $offers = Offers::where('listing_id',$this->id)->count('id');
        if($this->status=="cancelled"){
            $offers=0;
        }
        return $offers;
    }
    public function deal(){
        return $this->hasOne(Deals::class,'listing_id','id');
    }
}
