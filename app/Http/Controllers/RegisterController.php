<?php

namespace App\Http\Controllers;

// This controller handles user registration

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Show the registration page
    public function index()
    {
        return view('register');
    }

    // Process the registration form
    public function store(RegisterRequest $request)
    {
        // Create the new user
        $user = User::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        // Log the user in automatically
        Auth::login($user);

        // Redirect to the dashboard
        return redirect(route('dashboard.habits.index'));
    }
}
