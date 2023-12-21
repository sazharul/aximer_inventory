<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'customer_id',
        'sale_invoice_id',
        'amount',
    ];

    public function customerInfo()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function saleInvoiceInfo()
    {
        return $this->hasOne(SaleInvoice::class, 'id', 'sale_invoice_id');
    }
}
