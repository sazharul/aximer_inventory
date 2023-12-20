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
        'company_id',
        'supplier_id',
        'price',
        'stock',
        'discount_price',
        'discount_percentage',
        'is_flash_sale',
        'code',
        'product_color',
        'product_size',
        'origin',
        'status',
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
