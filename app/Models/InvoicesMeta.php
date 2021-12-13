<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicesMeta extends Model
{
    use HasFactory;
    protected $table = "invoices_meta";
    protected $fillable = [
        'invoice_id',
        'meta_key',
        'meta_value'
    ];
    public function invoice_meta()
    {
        return $this->morphTo();
    }
}
