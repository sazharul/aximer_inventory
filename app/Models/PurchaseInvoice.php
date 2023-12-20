<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'purchase_invoices';

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
    protected $fillable = ['purchase_id', 'purchase_no', 'date', 'payment_type', 'total', 'paid', 'due', 'status'];

    public function purchaseInvoiceDetails()
    {
        return $this->hasMany(PurchaseInvoiceDetail::class, 'purchase_invoices_id', 'id');
    }
}
