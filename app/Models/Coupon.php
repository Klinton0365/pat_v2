<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'start_date',
        'end_date',
        'usage_limit',
        'usage_count',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'value' => 'decimal:2',
    ];

    /**
     * Check if coupon is valid
     */
    public function isValid()
    {
        if (!$this->is_active) {
            return false;
        }

        $today = now();

        // Check start date
        if ($this->start_date && $today->lt($this->start_date)) {
            return false;
        }

        // Check end date
        if ($this->end_date && $today->gt($this->end_date)) {
            return false;
        }

        // Check usage limit
        if ($this->usage_limit && $this->usage_count >= $this->usage_limit) {
            return false;
        }

        return true;
    }

    /**
     * Calculate discount amount
     */
    public function calculateDiscount($subtotal)
    {
        if ($this->type === 'percentage') {
            return ($subtotal * $this->value) / 100;
        }

        return min($this->value, $subtotal);
    }

    /**
     * Increment usage count
     */
    public function incrementUsage()
    {
        $this->increment('usage_count');
    }

    /**
     * Scope for active coupons
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for valid coupons (not expired)
     */
    public function scopeValid($query)
    {
        $today = now();
        
        return $query->where('is_active', true)
            ->where(function ($q) use ($today) {
                $q->whereNull('start_date')
                  ->orWhere('start_date', '<=', $today);
            })
            ->where(function ($q) use ($today) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', $today);
            })
            ->where(function ($q) {
                $q->whereNull('usage_limit')
                  ->orWhereRaw('usage_count < usage_limit');
            });
    }
}