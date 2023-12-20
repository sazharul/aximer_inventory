<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_invoices_id',
        'product_id',
        'code',
        'product_name',
        'qty',
        'price',
        'total',
    ];
}
