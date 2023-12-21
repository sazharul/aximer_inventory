<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sales';

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
    protected $fillable = ['sale_id', 'customer_id', 'total', 'status'];


    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class, 'sale_id', 'id');
    }

    public function customerDetails()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function saleInvoice()
    {
        return $this->hasOne(SaleInvoice::class, 'sale_id', 'id');
    }
}
