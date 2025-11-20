<?php

namespace Sosupp\SlimerTenancy\Http\Controllers\Slimer\Landlord\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LandlordAuthController extends Controller
{
    public function showLoginForm()
    {

        return view('auth.landlord.login');
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::guard('landlord')->attempt($credentials)) {
            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::guard('landlord')->logout();
        return redirect('/');
    }
}
