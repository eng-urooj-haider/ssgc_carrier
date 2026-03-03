<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        // Get credentials from request
        $credentials = $request->only('email', 'password');
        // Attempt login using the 'web' guard
        if (!auth()->attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Login successful, get the authenticated user
        $user = auth()->user();
        $request->session()->regenerate();
        // Check user role and return appropriate response

        return response()->json([
            'message' => 'Login successful',
            'redirect' => $user->is_admin == 1 ? '/dashboard' : '/home' // frontend can use this to navigate
        ]);
    }
    public function user()
    {
        $user = auth()->user(); // already gets the logged-in user

        return response()->json([
            'user' => $user
        ]);
    }
    public function logout(Request $request)
    {
        // auth()->guard('web')->logout();       // Logs out the user
        auth()->logout();       // Logs out the user
        $request->session()->invalidate();     // Invalidates the session
        $request->session()->regenerateToken(); // Regenerates CSRF token

        return response()->json(['message' => 'Logged out successfully']);
    }


    public function register(RegisterRequest $request)
    {
        // Create the user
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Profile::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'cnic' => $request->cnic,
            'gender' => $request->gender
        ]);

        // Log the user in (session-based)
        Auth::login($user);

        return response()->json([
            'message' => 'Registration successful',
            'redirect' => '/home',
            'user' => $user
        ], 201);
    }
}
