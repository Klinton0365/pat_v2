<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    protected $fillable = [
        'product_id',
        'batch_id',
        'type',
        'quantity',
        'cost_price',
        'reference_type',
        'reference_id',
        'notes'
    ];

    public function batch()
    {
        return $this->belongsTo(InventoryBatch::class, 'batch_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
