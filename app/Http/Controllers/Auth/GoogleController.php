<?php

namespace App\Http\Controllers\Auth;

// This controller handles Google OAuth login

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class GoogleController extends Controller
{
    // Redirect the user to Google for authentication
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google calls this back after the user authorizes
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (InvalidStateException $e) {
            return redirect()->route('google.redirect');
        }

        $email = $googleUser->getEmail();
        $googleId = $googleUser->getId();
        $name = $googleUser->getName();
        $avatar = $googleUser->getAvatar();

        // 1. Is there already an account linked to this Google ID? -> Login directly
        $user = User::where('google_id', $googleId)->first();

        if ($user) {
            Auth::login($user);

            return redirect()->route('dashboard.habits.index');
        }

        // 2. Is there an account with the same email?
        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            // Already linked to Google (google_id filled) -> login and update ID if needed
            if (! is_null($existingUser->google_id)) {
                $existingUser->update([
                    'google_id' => $googleId,
                    'avatar_url' => $avatar,
                ]);

                Auth::login($existingUser);

                return redirect()->route('dashboard.habits.index');
            }

            // Account created via Google before (no password, no google_id) -> link and login
            if (is_null($existingUser->password)) {
                $existingUser->update([
                    'google_id' => $googleId,
                    'avatar_url' => $avatar,
                ]);

                Auth::login($existingUser);

                return redirect()->route('dashboard.habits.index');
            }

            // Account with password and no Google link -> ask for confirmation before linking
            session([
                'google_pending' => [
                    'google_id' => $googleId,
                    'email' => $email,
                    'avatar_url' => $avatar,
                ],
            ]);

            return redirect()->route('auth.google.link');
        }

        // 3. No account found -> Create new account without password
        $newUser = User::create([
            'name' => $name,
            'email' => $email,
            'google_id' => $googleId,
            'avatar_url' => $avatar,
            'password' => null,
        ]);

        Auth::login($newUser);

        return redirect()->route('dashboard.habits.index');
    }

    // Show the page to link a Google account to an existing account
    public function showLink()
    {
        if (! session('google_pending')) {
            return redirect()->route('login.index');
        }

        return view('auth.link-account', [
            'email' => session('google_pending.email'),
        ]);
    }

    // Process the linking (verify password and save google_id)
    public function link(Request $request)
    {
        $pending = session('google_pending');

        if (! $pending) {
            return redirect()->route('login.index');
        }

        $user = User::where('email', $pending['email'])->first();

        if (! $user) {
            return redirect()->route('login.index');
        }

        $request->validate([
            'password' => 'required|string',
        ]);

        // Verify the password
        if (! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        // Link Google to the existing account
        $user->update([
            'google_id' => $pending['google_id'],
            'avatar_url' => $pending['avatar_url'],
        ]);

        session()->forget('google_pending');

        Auth::login($user);

        return redirect()->route('dashboard.habits.index');
    }
}
