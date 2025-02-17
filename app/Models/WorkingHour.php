<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'saturday',
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'hospital_id', // Foreign key
    ];

    // Validation rules
    public static $rules = [
        'saturday' => 'nullable|string', // Allow flexible format (e.g., "9:00 AM - 5:00 PM" or "Closed")
        'sunday' => 'nullable|string',
        'monday' => 'nullable|string',
        'tuesday' => 'nullable|string',
        'wednesday' => 'nullable|string',
        'thursday' => 'nullable|string',
        'friday' => 'nullable|string',
        'hospital_id' => 'required|exists:hospitals,id', // Foreign key validation
    ];


    // Define the one-to-one relationship with Hospital
    public function hospital()
    {
        return $this->belongsTo(Hospital::class); // WorkingHour belongs to one Hospital
    }
}
