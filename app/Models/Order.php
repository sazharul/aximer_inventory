<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'user_name',
        'user_phone',
        'area_id',
        'address',
        'subtotal',
        'discount',
        'total',
        'delivery_date',
        'status',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id', 'id');
    }

    public function user_info()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function area()
    {
        return $this->hasOne(Area::class, 'id', 'area_id');
    }
}
