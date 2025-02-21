<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // For password hashing
use Illuminate\Support\Facades\Storage; // For file storage (if needed)
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function AdminLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function home()
    {
        return view('admin.home');
    }
    public function index()
    {
        $users = User::all(); // Or paginate: User::paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $user = new User();
            $user->fill($request->except('password', 'password_confirmation')); // Fill all except password
            $user->password = Hash::make($request->password); // Hash the password

            if ($request->hasFile('photo')) {
                // put image in the public storage
                $fileName = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('FeatureImage'), $fileName);
                $user['photo'] = $fileName;
            }
            $user->save();

            return redirect()->route('users.index')->with('success', 'User created successfully.');

        } catch (\Exception $e) {
            \Log::error($e);
            return back()->with('error', 'Error creating user. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $user)
    {

        $rules = User::rules();
        $user = User::whereId($user)->first();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id, // Ignore current user's email
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Example image validation
            'password' => 'nullable|string|min:8|confirmed', // Password validation
        ];

        $request->validate($rules);

        try {
            $user->fill($request->except('password', 'password_confirmation')); // Fill all except password

            if ($request->filled('password')) { // Only update password if a new one is provided
                $user->password = Hash::make($request->password);
            }

            if ($request->hasFile('photo')) {
                // Delete the old photo if it exists
                if ($user->photo) {
                    $oldPhotoPath = public_path('FeatureImage/' . $user->photo);
                    if (file_exists($oldPhotoPath)) {
                        unlink($oldPhotoPath);
                    }
                }

                $fileName = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('FeatureImage'), $fileName);
                $user->photo = $fileName;
            }

            $user->save();

            return redirect()->route('users.index')->with('success', 'User updated successfully.');

        } catch (\Exception $e) {
            \Log::error($e);
            return back()->with('error', 'Error updating user. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            if ($user->photo) {
                $oldPhotoPath = public_path('FeatureImage/' . $user->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
            $user->delete();

            return redirect()->route('users.index')->with('success', 'User deleted successfully.');

        } catch (\Exception $e) {
            \Log::error($e);
            return back()->with('error', 'Error deleting user. Please try again.');
        }
    }


    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;

            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('profile_photos', 'public');
                if ($user->photo) {
                    Storage::disk('public')->delete($user->photo);
                }
                $user->photo = $path;
            }

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return back()->with('success', 'Profile updated successfully!');

        } catch (\Exception $e) {
            \Log::error($e);
            return back()->with('error', 'Error updating profile. Please try again.');
        }
    }
    public function Slip()
    {
        return view('admin.slip');
    }
}
