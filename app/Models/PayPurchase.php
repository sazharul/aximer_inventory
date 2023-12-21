<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'supplier_id',
        'purchase_invoice_id',
        'amount',
    ];

    public function supplierInfo()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    public function purchaseInvoiceInfo()
    {
        return $this->hasOne(PurchaseInvoice::class, 'id', 'purchase_invoice_id');
    }
}
