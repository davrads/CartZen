<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class CustomerAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.customer-login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role !== 'customer') {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'Credentials do not match our records.',
                ]);
            }
            return redirect('/');
        }
        return back()->withErrors([
            'email' => 'Credentials do not match our records.',
        ]);
    }
    public function showRegister()
    {
        return view('auth.customer-register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'customer',
        ]);

        Auth::login($user);

        return redirect('/');
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function googleLogin()
    {
        session(['google_action' => 'login']);

        return Socialite::driver('google')->redirect();
    }

    public function googleRegister()
    {
        session(['google_action' => 'register']);

        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $action = session('google_action');

        $user = User::where('email', $googleUser->getEmail())
            ->where('role', 'customer')
            ->first();

        // LOGIN FLOW
        if ($action === 'login') {

            if (!$user) {
                return redirect()
                    ->route('register')
                    ->with('error', 'Account not found. Please register first.');
            }

            Auth::login($user);

            return redirect()->route('home');
        }

        // REGISTER FLOW
        if ($action === 'register') {

            if ($user) {
                return redirect()
                    ->route('login')
                    ->with('error', 'Account already exists. Please login.');
            }

            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => Hash::make(str()->random(32)),
                'role' => 'customer',
            ]);

            Auth::login($user);

            return redirect()->route('home');
        }

        return redirect()->route('login');
    }
}
