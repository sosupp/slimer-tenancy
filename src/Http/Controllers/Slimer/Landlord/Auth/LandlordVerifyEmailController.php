<?php

namespace Sosupp\SlimerTenancy\Http\Controllers\Slimer\Landlord\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class LandlordVerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user('landlord')->hasVerifiedEmail()) {
            return redirect()->intended(route('landlord.dashboard', absolute: false).'?verified=1');
        }

        if ($request->user('landlord')->markEmailAsVerified()) {
            event(new Verified($request->user('landlord')));
        }

        return redirect()->intended(route('landlord.dashboard', absolute: false).'?verified=1');
    }
}
