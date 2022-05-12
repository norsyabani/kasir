<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        session(['url.intended' => url()->previous()]);

        return view('login');
    }

    public function showLoginForm()
    {
        if(!session()->has('url.intended'))
        {
            session(['url.intended' => url()->previous()]);
        }
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {


            if(session()->has('url.intended'))
            {
                $url = session()->get('url.intended');
                return redirect($url);
                session()->forget('url.intended');
            } else {
                $request->session()->regenerate();
                return redirect('/');
                session()->forget('url.intended');
            }
        }

        return back()->with('loginError', 'Login Failed! check your credentials');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        session(['url.intended' => url()->previous()]);

        return redirect('/login');
    }
}
