<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidates = Candidate::all(); // Or paginate: Candidate::paginate(10);
        return view('candidates.index', compact('candidates')); // Example view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agents = Agent::all(); // Get all agents for the dropdown
        return view('candidates.create', compact('agents')); // Example view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Candidate::$rules); // Use the rules defined in the model

        $candidate = new Candidate();
        $candidate->fill($request->all()); // Use fill to mass-assign the attributes
        $candidate->save();

        return redirect()->route('candidates.index')->with('success', 'Candidate created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        return view('candidates.show', compact('candidate')); // Example view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        $agents = Agent::all(); // Get all agents for the dropdown
        return view('candidates.edit', compact('candidate', 'agents')); // Example view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $candidate)
    {
        // Modify rules for unique fields during update
        $rules = Candidate::$rules;
        $rules['email_id'] = ['required', 'email', 'max:255', Rule::unique('candidates')->ignore($candidate->id)];
        $rules['passport_number'] = ['required', 'string', 'max:255', Rule::unique('candidates')->ignore($candidate->id)];


        $request->validate($rules);

        $candidate->fill($request->all());  // Use fill to update
        $candidate->save();

        return redirect()->route('candidates.index')->with('success', 'Candidate updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
        return redirect()->route('candidates.index')->with('success', 'Candidate deleted successfully.');
    }
}
