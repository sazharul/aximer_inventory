<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleInvoice extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sale_invoices';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['sale_id', 'sale_no', 'sale_invoice_no', 'date', 'payment_type', 'total', 'discount', 'paid', 'due', 'status'];

    public function saleInvoiceDetails()
    {
        return $this->hasMany(SaleInvoiceDetail::class, 'sale_invoices_id', 'id');
    }

    public function customerDetails()
    {
        return $this->hasOneThrough(Customer::class, Sale::class, 'id', 'id', 'sale_id', 'customer_id');
        //return $this->hasMany(SaleInvoiceDetail::class, 'sale_invoices_id', 'id');
    }
}
