<?php

namespace Sosupp\SlimerTenancy\Http\Controllers\Slimer\Landlord\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LandlordEmailVerificationNotificationController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        if ($request->user('landlord')->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $request->user('landlord')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}