<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller
{
    private $user;

    public function getNames() {
        $users = User::select('id', 'name')->get(); 
        return $users;
    }

    public function index()
    {
        $users = User::all(); // Retrieve all users from the database
        return view('users', compact('users'));
    }

    public function store(Request $request)
    {
        // Validate the incoming user data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users',
            'password' => 'required|string',
            'role' => 'required|string|in:health_professional,first_aide',
        ]);

        
        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create a new user model instance and fill it with the user's responses
        $user = new User();
        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->password = $validatedData['password'];
        $user->role = $validatedData['role'];

        // Save the user to the database
        $user->save();

        // Redirect to a success page or perform any other actions
        return redirect()->back()->with('success', 'User added successfully');
    }

    public function deleteUser($id)
    {
        // Find the user with the given ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }

        // Ensure that the admin user cannot be deleted
        if ($user->name == 'Admin') {
            return redirect()->route('users.index')->with('error', 'Admin user cannot be deleted.');
        }

        // Delete the user
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function updateUser(Request $request, $id)
    {
        // Validation logic if needed

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->pin_code = $request->input('pin_code');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->back()->with('success', 'User updated successfully.');
    }

}

