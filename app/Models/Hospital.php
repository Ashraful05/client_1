<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'website',
        'working_hours',
    ];

    // Validation rules (recommended)
    public static $rules = [
        'name' => 'required|string|max:255',
        'address' => 'required|string', // No max length needed for address usually
        'phone' => 'nullable|string|max:255', // Phone can be optional
        'email' => 'nullable|email|max:255',  // Email can be optional
        'website' => 'nullable|url|max:255', // Website should be a URL
        'working_hours' => 'nullable|string', // Working hours can be flexible
    ];
}
