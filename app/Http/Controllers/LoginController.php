<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        $data = [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];

        $credentials = $request->validate($data);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function logout(Request $request): RedirectResponse
    {
        session()->flush();
        Auth::guard('web')->logout();
        return redirect(route('login'));
    }

    public function loginPage()
    {
        return view('auth.login');
    }
}
