<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'order_id',
        'item_id',
        'qty',
        'price',
        'discount',
        'total',
        'note'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function item()
    {
        return $this->hasOne(items::class, 'uuid', 'item_id');
    }
}
