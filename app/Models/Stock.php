<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stocks';

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
    protected $fillable = [
        'product_id',
        'purchase_id',
        'purchase_no',
        'qty',
        'date'
    ];


    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

}
