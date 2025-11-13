<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

        protected $fillable = [
        'user_id',
        'order_number',
        'invoice_no',
        'transaction_id',
        'razorpay_payment_id',
        'razorpay_order_id',
        'razorpay_signature',
        'subtotal',
        'discount_amount',
        'coupon_discount',
        'coupon_code',
        'tax_amount',
        'shipping_amount',
        'total_amount',
        'payment_status',
        'order_status',
        'payment_date',
        'shipping_first_name',
        'shipping_last_name',
        'shipping_email',
        'shipping_phone',
        'shipping_address',
        'shipping_city',
        'shipping_state',
        'shipping_zip',
        'shipping_country',
        'payment_method',
        'currency',
        'notes',
        'tracking_number',
        'shipped_at',
        'delivered_at',
        'cancelled_at',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($order) {
            $order->order_number = 'ORD-' . strtoupper(Str::random(8));
            $order->invoice_no = 'INV-' . now()->format('Y') . '-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);

            // Unique alphanumeric transaction ID
            do {
                $txn = 'TXN-' . strtoupper(Str::random(10));
            } while (self::where('transaction_id', $txn)->exists());
            $order->transaction_id = $txn;
        });
    }
    
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
