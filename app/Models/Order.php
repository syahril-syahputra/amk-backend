<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function order_item()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'uuid');
    }
    public function customer()
    {
        return $this->hasOne(Customer::class, 'uuid', 'customer_id');
    }
}
