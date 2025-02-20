<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Models\Employers;
use App\Models\User;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Rate limit check before validation
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 3)) {
            $seconds = RateLimiter::availableIn($this->throttleKey($request));

            throw ValidationException::withMessages([
                'email' => [
                    "Too many login attempts. Please try again in {$seconds} seconds."
                ],
            ]);
        }

        // Validate the request...
        $validatedAttributes = $request->validate([
            'email' => 'required|email|lowercase',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user...
        if (Auth::attempt($validatedAttributes)) {
            // On successful login, clear rate limiter
            RateLimiter::clear($this->throttleKey($request));

            // regenerates the session ID
            $request->session()->regenerate();

            // Redirect to the home page...
            return redirect('/');
        }

        // On failed attempt, increment the rate limiter
        RateLimiter::hit($this->throttleKey($request));

        // Validation fails...
        throw ValidationException::withMessages([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }

    //Get the rate limiting throttle key for the request.
    private function throttleKey(Request $request): string
    {
        return Str::lower($request->input('email')) . '|' . $request->ip();
    }

    public function profile()
    {
        $users = User::all();
        return view('profile.index', ['users'=>$users]);
    }

    public function destroy()
    {
        // Log the user out...
        Auth::logout();
        // Redirect...
        return redirect('/login');
    }
}
