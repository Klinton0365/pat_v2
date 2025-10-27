<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FestivalOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'title',
        'slug',
        'description',
        'offer_price',
        'is_percentage',
        'start_date',
        'end_date',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
