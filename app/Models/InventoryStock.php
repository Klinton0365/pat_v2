<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryStock extends Model
{
    protected $table = 'inventory_stock';

    protected $fillable = [
        'product_id',
        'total_stock',
        'reserved_stock',
        'available_stock'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function batches()
    {
        return $this->hasMany(InventoryBatch::class, 'product_id', 'product_id');
    }

    public function movements()
    {
        return $this->hasMany(InventoryMovement::class, 'product_id', 'product_id');
    }
}
