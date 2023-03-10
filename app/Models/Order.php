<?php

namespace App\Models;

use App\Observers\OrderObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'number', 'user_id', 'shipping', 'discount', 'tax', 'total',
        'status', 'payment_status', 'shipping_name', 'billing_city',
        'shipping_email', 'shipping_phone', 'shipping_address', 'shipping_city',
        'shipping_country', 'billing_name', 'billing_email',
        'billing_phone', 'billing_address', 'billing_country', 'notes',
    ];
    protected $dates = ['deleted_at'];

    protected static function booted()
    {
        static::observe(OrderObserver::class);
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
