<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::all(); // Or paginate: Appointment::paginate(10);
        return view('appointments.index', compact('appointments')); // Example view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $candidates = Candidate::all();
        $agents = Agent::all();
        $payments = Payment::all(); // Get all payments for the dropdown

        return view('appointments.create', compact('candidates', 'agents', 'payments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Appointment::$rules);

        $appointment = new Appointment();
        $appointment->fill($request->all());
        $appointment->save();

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $candidates = Candidate::all();
        $agents = Agent::all();
        $payments = Payment::all(); // Get all payments for the dropdown

        return view('appointments.edit', compact('appointment', 'candidates', 'agents', 'payments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        // Modify rules for unique fields during update
        $rules = Appointment::$rules;
        $rules['merchant_reference'] = ['required', 'string', 'max:255', Rule::unique('appointments')->ignore($appointment->id)];
        $rules['payment_id'] = ['required', 'exists:payments,id', Rule::unique('appointments')->ignore($appointment->id)];

        $request->validate($rules);

        $appointment->fill($request->all());
        $appointment->save();

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
