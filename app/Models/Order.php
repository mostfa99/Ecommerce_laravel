<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'user_id', 'shipping', 'discount', 'tax', 'total',
        'status', 'payment_status', 'shipping_name', 'billing_city',
        'shipping_email', 'shipping_phone', 'shipping_address', 'shipping_city',
        'shipping_country', 'billing_name', 'billing_email',
        'billing_phone', 'billing_address', 'billing_country', 'notes',
    ];

    protected static function booted()
    {
        static::creating(function (Order $order) {
            // عشان انشى ارقام الطلبات داخل المتجر بتاريخ السنة
            $now = Carbon::now();
            $number = Order::whereYear('created_at', '=', $now->year)->max('number');

            $order->number = $number ? $number + 1 : $now->year . '0001';
            if (!$order->shipping_name) {
                $order->shipping_name = $order->billing_name;
            }
            if (!$order->shipping_email) {
                $order->shipping_email = $order->billing_email;
            }
            if (!$order->shipping_country) {
                $order->shipping_country = $order->billing_country;
            }
            if (!$order->shipping_city) {
                $order->shipping_city = $order->billing_city;
            }
            if (!$order->shipping_address) {
                $order->shipping_address = $order->billing_address;
            }
            if (!$order->shipping_phone) {
                $order->shipping_phone = $order->billing_phone;
            }
        });
    }
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
        return $this->belongsToMany(Product::class, 'order_items')
            ->using(OrderItem::class)
            ->as('items')
            // laravel will not return data beccouse it we need call it by
            ->withPivot(['quantity', 'price']);
    }
}
