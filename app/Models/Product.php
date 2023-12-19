<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

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
        'image',
        'name',
        'category_id',
        'code',
        'price',
        'origin',
        'product_color',
        'product_size',
        'supplier_id',
        'status'
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function suppliers()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

}
