<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Candidate;
use App\Models\Agent;
use App\Models\Payment;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating a new appointments and associating models:
        $candidate = Candidate::find(1);
        $agent = Agent::find(2);
        $payment = Payment::find(3); // Assuming the payment is already created

        $appointment = new Appointment([
            'merchant_reference' => 'MR12345',
            'gcc_slip_no' => 'GS12345',
            'entry_date' => '2024-08-22',
            'validity_date' => '2025-08-22',
        ]);

        $appointment->candidate()->associate($candidate);
        $appointment->agent()->associate($agent);
        $appointment->payment()->associate($payment); // Associate the payment
        $appointment->save();

// Accessing related data:
        $appointment = Appointment::find(1);
        echo $appointment->candidate->first_name;
        echo $appointment->agent->full_name;
        echo $appointment->payment->amount;
    }
}
