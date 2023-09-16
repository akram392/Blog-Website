<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // $request->session()->regenerate();
        // return redirect()->intended(RouteServiceProvider::ADMIN_HOME);

        if ( auth()->user()->is_admin == 1 || auth()->user()->is_admin == 3 ) {
            # code...
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
        }
        elseif ( auth()->user()->is_admin == 2 ) {
            # code...
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::USER_HOME);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
