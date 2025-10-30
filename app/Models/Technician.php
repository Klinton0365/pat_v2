<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    protected $fillable = [
        'user_id',
        'employee_code',
        'specialization',
        'experience_years',
        'certification_no',
        'service_area',
        'rating',
        'on_duty',
        'active',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    // Accessors
    public function getStatusLabelAttribute()
    {
        return $this->active ? 'Active' : 'Inactive';
    }

    public function getDutyStatusAttribute()
    {
        return $this->on_duty ? 'On Duty' : 'Available';
    }

    // Scope for filtering available technicians
    public function scopeAvailable($query)
    {
        return $query->where('active', 1)->where('on_duty', 0);
    }
}
