<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::all(); // Or paginate: Agent::paginate(10);
        return view('agents.index', compact('agents')); // Example view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agents.create'); // Example view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:agents',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:' . implode(',', Agent::ROLES),
            'status' => 'required|string|in:' . implode(',', Agent::STATUSES),
        ]);

        $agent = new Agent();
        $agent->full_name = $request->input('full_name');
        $agent->email = $request->input('email');
        $agent->password = Hash::make($request->input('password')); // Hash the password
        $agent->role = $request->input('role');
        $agent->status = $request->input('status');
        $agent->save();

        return redirect()->route('agents.index')->with('success', 'Agent created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        return view('agents.show', compact('agent')); // Example view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agent $agent)
    {
        return view('agents.edit', compact('agent')); // Example view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agent $agent)
    {

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('agents')->ignore($agent->id)], // Ignore current agent's email
            'password' => 'nullable|string|min:8|confirmed', // Password is optional on update
            'role' => 'required|string|in:' . implode(',', Agent::ROLES),
            'status' => 'required|string|in:' . implode(',', Agent::STATUSES),
        ]);

        $agent->full_name = $request->input('full_name');
        $agent->email = $request->input('email');

        if ($request->filled('password')) { // Only update if a new password is provided
            $agent->password = Hash::make($request->input('password'));
        }

        $agent->role = $request->input('role');
        $agent->status = $request->input('status');
        $agent->save();

        return redirect()->route('agents.index')->with('success', 'Agent updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        $agent->delete();
        return redirect()->route('agents.index')->with('success', 'Agent deleted successfully.');
    }
}
