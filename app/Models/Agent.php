<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // For authentication
use Illuminate\Notifications\Notifiable; // For notifications (optional)


class Agent extends Authenticatable // Inherit from Authenticatable for auth
{
    use HasFactory, Notifiable; // Use HasFactory and Notifiable traits

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', // Hide password for security
        'remember_token', // Hide remember_token
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // Cast email_verified_at to datetime
        'password' => 'hashed', // Hash the password securely
    ];


    // Define the valid roles and statuses (optional but recommended)
    public const ROLES = ['agent', 'admin', 'client'];
    public const STATUSES = ['active', 'inactive'];

    // Validation rules (recommended)
//    public static $rules = [
//        'full_name' => 'required|string|max:255',
//        'email' => 'required|string|email|max:255|unique:agents', // Unique email
//        'password' => 'required|string|min:8|confirmed', // Password confirmation
//        'role' => 'required|string|in:' . implode(',', self::ROLES), // Validate role
//        'status' => 'required|string|in:' . implode(',', self::STATUSES), // Validate status
//    ];

    // Scopes for filtering (optional but useful)

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeAgent($query)
    {
        return $query->where('role', 'agent');
    }

    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeClient($query)
    {
        return $query->where('role', 'client');
    }


}
