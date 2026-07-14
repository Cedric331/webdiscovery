<?php

namespace App\Http\Controllers\CustomerPortal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('customer-portal.dashboard');
        }

        return Inertia::render('CustomerPortal/Login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::guard('customer')->attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Les identifiants fournis sont incorrects.',
            ])->onlyInput('email');
        }

        $customer = Auth::guard('customer')->user();

        if (! $customer->portal_enabled) {
            Auth::guard('customer')->logout();
            return back()->withErrors([
                'email' => 'Votre accès au portail est désactivé. Contactez-nous pour plus d\'informations.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->route('customer-portal.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('customer-portal.login');
    }
}
