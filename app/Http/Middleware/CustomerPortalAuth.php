<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerPortalAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::guard('customer')->check()) {
            return redirect()->route('customer-portal.login');
        }

        $customer = Auth::guard('customer')->user();

        if (! $customer->portal_enabled) {
            Auth::guard('customer')->logout();
            return redirect()->route('customer-portal.login')
                ->withErrors(['email' => 'Votre accès au portail est désactivé.']);
        }

        return $next($request);
    }
}
