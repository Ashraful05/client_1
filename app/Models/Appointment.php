<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_reference',
        'gcc_slip_no',
        'candidate_id',
        'agent_id',
        'entry_date',
        'validity_date',
        'payment_id',
    ];

    // Validation rules
    public static $rules = [
        'merchant_reference' => 'required|string|max:255|unique:appointments', // Unique merchant reference
        'gcc_slip_no' => 'nullable|string|max:255',
        'candidate_id' => 'required|exists:candidates,id', // Foreign key validation
        'agent_id' => 'required|exists:agents,id',       // Foreign key validation
        'entry_date' => 'required|date',
        'validity_date' => 'required|date|after:entry_date',  // Validity after entry
        'payment_id' => 'required|exists:payments,id|unique:appointments', // Foreign key and unique
    ];

    // Relationships
    public function candidate()
    {
        return $this->belongsTo(Candidate::class); // Appointment belongs to one Candidate
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);     // Appointment belongs to one Agent
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);   // Appointment belongs to one Payment
    }
}
