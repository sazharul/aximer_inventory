<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'address',
        'contact_person',
        'origin',
        'status',
    ];

    public function saleInvoiceInfo()
    {
        return $this->hasOneThrough(SaleInvoice::class, Sale::class, 'customer_id', 'sale_id', 'id', 'id');
        //return $this->hasMany(SaleInvoiceDetail::class, 'sale_invoices_id', 'id');
    }


    public function saleInvoice()
    {
        return $this->hasMany(Sale::class, 'customer_id', 'id');
        //return $this->hasMany(SaleInvoiceDetail::class, 'sale_invoices_id', 'id');
    }
}
