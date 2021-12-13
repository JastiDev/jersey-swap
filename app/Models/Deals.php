<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stripe\Review;

class Deals extends Model
{
    use HasFactory;
    protected $table="deals";
    protected $fillable=[
        'deal_number',
        'listing_id',
        'offer_id',
        'deal_status',
        'lister_paid',
        'offerMaker_paid'
    ];
    public function deal()
    {
        return $this->belongsTo(Invoices::class,'id','deal_id');
    }
    public function listing(){
        return $this->belongsTo(Listing::class,'listing_id','id');
    }
    public function offer(){
        return $this->belongsTo(Offers::class,'offer_id','id');
    }
    public function reviews(){
        return Reviews::where([
            'deal_id' => $this->id
        ])->get();
    }
    public function my_review(){
        $review = Reviews::where([
            'deal_id' => $this->id,
            'given_by' => auth()->user()->id
        ])->first();
        if($review==null){
            return null;
        }
        return $review;
    }
}
