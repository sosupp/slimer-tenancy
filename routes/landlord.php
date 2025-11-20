<?php
use Illuminate\Support\Facades\Route;

    Route::middleware('guest:landlord')->group(function () {
        Route::get('/login', [LandlordAuthController::class, 'showLoginForm'])->name('landlord.login');

        Route::post('/login', [LandlordAuthController::class, 'login'])->name('landlord.login.store');
        Route::post('/login', [LandlordAuthController::class, 'login'])->name('login');

        Route::get('forgot-password', [LandlordPasswordResetLinkController::class, 'create'])
            ->name('landlord.password.request');

        Route::post('forgot-password', [LandlordPasswordResetLinkController::class, 'store'])
            ->name('landlord.password.email');
    });

    Route::middleware('auth:landlord')->group(function () {


        Route::get('verify-email', LandlordEmailVerificationPromptController::class)
            ->name('landlord.verification.notice');

        Route::get('verify-email/{id}/{hash}', LandlordVerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('landlord.verification.verify');

        Route::post('email/verification-notification', [
            LandlordEmailVerificationNotificationController::class, 'store'
        ])
            ->middleware('throttle:6,1')
            ->name('landlord.verification.send');

        Route::get('confirm-password', [LandlordConfirmablePasswordController::class, 'show'])
            ->name('landlord.password.confirm');

        Route::post('confirm-password', [LandlordConfirmablePasswordController::class, 'store']);

        Route::put('password', [LandlordPasswordController::class, 'update'])->name('landlord.password.update');
        Route::post('/logout', [LandlordAuthController::class, 'logout'])->name('landlord.logout');
    });
