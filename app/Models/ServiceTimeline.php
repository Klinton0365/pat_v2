<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTimeline extends Model
{
    protected $fillable = [
        'service_id',
        'status',
        'remarks',
        'logged_at',
    ];

    protected $casts = [
        'logged_at' => 'datetime',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
