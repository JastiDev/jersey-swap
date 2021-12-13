<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;
    protected $table="invoices";
    protected $fillable = [
        'user_id',
        'deal_id',
        'billable_amount',
        'invoice_status',
        'created_at'
    ];
    public function deal()
    {
        return $this->belongsTo(Deals::class,'id','deal_id');
    }
    public function invoice_meta(){
        $invoice_metas = InvoicesMeta::where('invoice_id',$this->id)->get();
        return $invoice_metas;
    }
}
