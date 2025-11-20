<?php

namespace Sosupp\SlimerTenancy\Http\Controllers\Slimer\Landlord\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class LandlordEmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user(guard: 'landlord')->hasVerifiedEmail()
            ? redirect()->intended(route('landlord.dashboard', absolute: false))
            : view('auth.landlord.verify-email');
    }
}
