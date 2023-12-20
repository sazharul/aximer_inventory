<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'purchases';

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
    protected $fillable = ['purchase_id', 'supplier_name', 'total', 'status'];


    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetails::class, 'purchase_id', 'id');
    }
}
