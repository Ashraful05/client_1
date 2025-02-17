<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitals = Hospital::all(); // Or paginate: Hospital::paginate(10);
        return view('hospitals.index', compact('hospitals')); // Example view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hospitals.create'); // Example view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Hospital::$rules); // Use the rules defined in the model

        $hospital = new Hospital();
        $hospital->fill($request->all()); // Mass assign (important: $fillable in Model!)
        $hospital->save();

        return redirect()->route('hospitals.index')->with('success', 'Hospital created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hospital $hospital)
    {
        return view('hospitals.show', compact('hospital')); // Example view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hospital $hospital)
    {
        return view('hospitals.edit', compact('hospital')); // Example view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hospital $hospital)
    {
        $request->validate(Hospital::$rules); // Validate

        $hospital->fill($request->all()); // Mass assign (important: $fillable in Model!)
        $hospital->save();

        return redirect()->route('hospitals.index')->with('success', 'Hospital updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hospital $hospital)
    {
        $hospital->delete();
        return redirect()->route('hospitals.index')->with('success', 'Hospital deleted successfully.');
    }
}
