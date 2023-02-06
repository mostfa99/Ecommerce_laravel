<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'user_id', 'shipping', 'discount', 'tax', 'total',
        'status', 'payment_status', 'shipping_firstname', 'shipping_lastname',
        'shipping_email', 'shipping_phone', 'shipping_address', 'shipping_city',
        'shipping_country', 'billing_firstname', 'billing_lastname', 'billing_email',
        'billing_phone', 'billing_address', 'billing_country', 'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    // what product in order with table order
    public function produts()
    {
        return $this->belongsToMany(Product::class, 'order_item')
            ->using(OrderItem::class)
            ->as('items')
            // laravel will not return data beccouse it we need call it by
            ->withPivot('quantity', 'price');
    }
}
