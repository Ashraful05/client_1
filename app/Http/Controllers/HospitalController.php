<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\WorkingHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitals = Hospital::orderBy('name', 'asc')->get(); // Or paginate: Hospital::paginate(10);
        return view('hospital.index', compact('hospitals')); // Example view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hospital.create'); // Example view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction(); // Start a database transaction

            $hospital = new Hospital();
            $hospital->name = $request->input('name');
            $hospital->address = $request->input('address');
            $hospital->phone = $request->input('phone');
            $hospital->email = $request->input('email');
            $hospital->website = $request->input('website');
            $hospital->save();

            foreach ($request->input('working_hours') as $hours) {
                $workingHour = new WorkingHour();
                $workingHour->hospital_id = $hospital->id; // Associate with the hospital
                $workingHour->day = $hours['day'];
                $workingHour->start_time = $hours['start_time'];
                $workingHour->end_time = $hours['end_time'];
                $workingHour->save();
            }

            DB::commit(); // Commit the transaction
            return redirect()->route('hospital.index')->with('success', 'Hospital created successfully.'); // Redirect after successful creation

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback if any error occurs
            // Log the error for debugging:
            \Log::error($e);
            return back()->with('error', 'Error creating hospital. Please try again.'); // Redirect back with an error message
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($hospital)
    {
        try {
            // Eager load the working hours to avoid N+1 problem (optional but recommended)
            // $hospital->load('workingHours'); // Or
            $hospital = Hospital::whereId($hospital)->first();
            $hospitals = Hospital::get();
            if($hospital){
                return view('hospital.show', compact('hospital'));
            }
            else{
                return redirect('/dashboard')->with('error', 'No such a Hospital!');
            }

        } catch (\Exception $e) {
            // Log the error (crucial for debugging)
            \Log::error($e);

            // Handle the error (e.g., redirect back with an error message)
            return back()->with('error', 'Error displaying hospital details. Please try again.'); // Or a more specific message if needed
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($hospital)
    {
        try {
            $hospital = Hospital::whereId($hospital)->first();
            return view('hospital.edit', compact('hospital')); // Example view

        } catch (\Exception $e) {
            // Log the error (crucial for debugging)
            \Log::error($e);

            // Handle the error (e.g., redirect back with an error message)
            return back()->with('error', 'Error displaying hospital details. Please try again.'); // Or a more specific message if needed
        }
    }


    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $hospital)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            // ... other validation rules
        ]);

        try {
            $hospital = Hospital::whereId($hospital)->first();
            $hospital->update($request->except('working_hours')); // Update basic hospital info

            // Update Working Hours (handle array of working hours)
            if ($request->has('working_hours')) {
                $workingHoursData = $request->input('working_hours');

                // Sync working hours (more efficient if you want to replace all)
                $hospital->workingHours()->delete(); // Delete existing working hours first
                foreach ($workingHoursData as $hours) {
                    $hospital->workingHours()->create($hours);
                }

                // Or, if you want to update/create individually (more complex):
                // foreach ($workingHoursData as $hours) {
                //     if (isset($hours['id'])) { // If working hour has an ID, update it
                //         WorkingHour::find($hours['id'])->update($hours);
                //     } else { // Otherwise, create a new working hour
                //         $hospital->workingHours()->create($hours);
                //     }
                // }


            } else {
                //If working hours are not provided, delete existing working hours
                $hospital->workingHours()->delete();
            }

            return redirect()->route('hospital.index')->with('success', 'Hospital updated successfully.');

        } catch (\Exception $e) {
            \Log::error($e);
            return back()->with('error', 'Error updating hospital. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($hospital)
    {
        $hospital = Hospital::whereId($hospital)->first();
        $hospital->delete();
        return redirect()->route('hospital.index')->with('success', 'Hospital deleted successfully.');
    }
}
