<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'customer_id',
        'product_id',
        'order_id',
        'service_code',
        'source_type',
        'external_product_name',
        'issue_type',
        'problem_description',
        'status',
        'scheduled_date',
        'next_service_date',
        'completed_at',
        'technician_id',
    ];

    protected $casts = [
        'scheduled_date' => 'datetime',
        'next_service_date' => 'datetime',
        'completed_at' => 'datetime',
    ];

    // protected $casts = [
    //     'scheduled_date' => 'datetime',
    //     'completed_at' => 'datetime',
    // ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function items()
    {
        return $this->hasMany(ServiceItem::class);
    }

    public function timelines()
    {
        return $this->hasMany(ServiceTimeline::class)->orderBy('logged_at', 'asc');
    }

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }

    // Helper for readable status
    public function getStatusLabelAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }
}
