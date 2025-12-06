<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryBatch extends Model
{
    protected $fillable = [
        'product_id',
        'batch_no',
        'quantity',
        'remaining_quantity',
        'purchase_price',
        'arrival_date',
        'supplier_name'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function movements()
    {
        return $this->hasMany(InventoryMovement::class);
    }
}
