<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'candidate_id',
        'transaction_id',
        'payment_status',
        'amount',
        'date',
    ];

    // Define valid payment statuses (recommended)
    public const PAYMENT_STATUSES = ['pending', 'completed', 'failed', 'refunded'];

    // Validation rules
//    public static $rules = [
//        'agent_id' => 'required|exists:agents,id', // Foreign key validation
//        'candidate_id' => 'required|exists:candidates,id', // Foreign key validation
//        'transaction_id' => 'required|string|max:255|unique:payments', // Unique transaction ID
//        'payment_status' => 'required|string|in:' . implode(',', self::PAYMENT_STATUSES),
//        'amount' => 'required|numeric|min:0', // Amount should be a positive number
//        'date' => 'required|date',
//    ];

    // Relationships
    public function candidate()
    {
        return $this->belongsTo(Candidate::class); // Payment belongs to one Candidate
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class); // Payment belongs to one Agent
    }
}
