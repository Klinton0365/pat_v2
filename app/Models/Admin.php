<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';

    protected $fillable = [
        'user_id',
        'role',
        'is_active',
        'permissions',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'permissions' => 'array', // if stored as JSON
    ];

    /**
     * Relation: Admin belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
