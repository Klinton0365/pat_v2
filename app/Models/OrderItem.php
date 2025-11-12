<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_sku',
        'product_image',
        'quantity',
        'price',
        'discount',
        'final_price',
        'tax_amount',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'final_price' => 'decimal:2',
        'tax_amount' => 'decimal:2',
    ];

    /**
     * Boot method for generating optional item reference or defaults.
     */
    protected static function booted()
    {
        static::creating(function ($item) {
            // Example: you could create an item reference if needed (optional)
            if (!isset($item->product_name) && $item->product) {
                $item->product_name = $item->product->name ?? 'Unknown Product';
            }
        });
    }

    /**
     * Each order item belongs to an order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Each order item belongs to a product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
