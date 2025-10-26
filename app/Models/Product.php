<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'price', 'discount', 'warranty_months', 'main_image',
        'product_images', 'colors', 'stock', 'sku',
        'is_published', 'publish_home', 'featured',
        'views', 'rating',
    ];

    protected $casts = [
        'product_images' => 'array',
        'colors' => 'array', // ✅ auto decode JSON
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }

    public function festivalOffer()
    {
        return $this->hasOne(FestivalOffer::class);
    }
}
