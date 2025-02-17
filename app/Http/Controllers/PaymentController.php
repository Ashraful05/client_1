<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::all(); // Or paginate: Payment::paginate(10);
        return view('payments.index', compact('payments')); // Example view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $candidates = Candidate::all(); // Get all candidates for dropdown
        $agents = Agent::all();       // Get all agents for dropdown
        return view('payments.create', compact('candidates', 'agents')); // Example view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Payment::$rules); // Validate using model rules

        $payment = new Payment();
        $payment->fill($request->all()); // Mass assign (check $fillable in model!)
        $payment->save();

        return redirect()->route('payments.index')->with('success', 'Payment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment')); // Example view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $candidates = Candidate::all(); // Get all candidates for dropdown
        $agents = Agent::all();       // Get all agents for dropdown
        return view('payments.edit', compact('payment', 'candidates', 'agents')); // Example view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        // Modify rules for unique fields during update
        $rules = Payment::$rules;
        $rules['transaction_id'] = ['required', 'string', 'max:255', Rule::unique('payments')->ignore($payment->id)];

        $request->validate($rules);

        $payment->fill($request->all()); // Mass assign (check $fillable in model!)
        $payment->save();

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }
}
