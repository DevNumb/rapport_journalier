<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        // Login logic here...

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role === 'worker') {
                return redirect()->route('worker.dashboard');
            }
        }
    }




    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'credentials' => 'The provided credentials do not match our records.',
        ]);
    }
}
