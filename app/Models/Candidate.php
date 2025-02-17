<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'nationality',
        'gender',
        'marital_status',
        'passport_number',
        'confirm_passport', // Add this field
        'passport_issue_date',
        'passport_issue_place',
        'passport_expiry_date',
        'visa_type',
        'email_id',
        'phone',
        'national_id',
        'position_applied_for',
        'other',
        'confirm', // Add this field
        'agent_id', // Foreign key to agents table
    ];

    // Define valid options (recommended)
    public const GENDERS = ['male', 'female', 'other'];
    public const MARITAL_STATUSES = ['single', 'married', 'divorced', 'widowed']; // Add more as needed


    // Validation rules (important)
//    public static $rules = [
//        'first_name' => 'required|string|max:255',
//        'last_name' => 'required|string|max:255',
//        'date_of_birth' => 'required|date',
//        'nationality' => 'required|string|max:255',
//        'gender' => 'required|string|in:' . implode(',', self::GENDERS),
//        'marital_status' => 'required|string|in:' . implode(',', self::MARITAL_STATUSES),
//        'passport_number' => 'required|string|max:255',
//        'confirm_passport' => 'required|same:passport_number', // Confirmation check
//        'passport_issue_date' => 'required|date',
//        'passport_issue_place' => 'required|string|max:255',
//        'passport_expiry_date' => 'required|date|after:today', // Check expiry date
//        'visa_type' => 'nullable|string|max:255', // Visa type is optional
//        'email_id' => 'required|email|max:255',
//        'phone' => 'required|string|max:255',
//        'national_id' => 'required|string|max:255',
//        'position_applied_for' => 'required|string|max:255',
//        'other' => 'nullable|string', // Other details are optional
//        'confirm' => 'required|accepted', // Confirmation checkbox
//        'agent_id' => 'required|exists:agents,id', // Foreign key validation
//    ];

    // Relationship with Agent model
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

}
