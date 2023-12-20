<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleInvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_invoices_id',
        'product_id',
        'code',
        'product_name',
        'qty',
        'price',
        'total',
    ];
}
