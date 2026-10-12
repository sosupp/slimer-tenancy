<?php
use App\Livewire\Landlord\LandlordHome;
use App\Livewire\Landlord\TenantList;
use App\Livewire\Landlord\Blogs\BlogMake;
use App\Livewire\Landlord\Blogs\BlogsList;
use Illuminate\Support\Facades\Route;
use Sosupp\SlimerTenancy\Http\Controllers\Slimer\Site\BlogController;
use Sosupp\SlimerTenancy\Http\Controllers\Slimer\Site\DemoAccountController;
use Sosupp\SlimerTenancy\Http\Controllers\Slimer\Site\FaqController;
use Sosupp\SlimerTenancy\Http\Controllers\Slimer\Landlord\Auth\LandlordAuthController;
use Sosupp\SlimerTenancy\Http\Controllers\Slimer\Landlord\Auth\LandlordConfirmablePasswordController;
use Sosupp\SlimerTenancy\Http\Controllers\Slimer\Landlord\Auth\LandlordEmailVerificationNotificationController;
use Sosupp\SlimerTenancy\Http\Controllers\Slimer\Landlord\Auth\LandlordEmailVerificationPromptController;
use Sosupp\SlimerTenancy\Http\Controllers\Slimer\Landlord\Auth\LandlordPasswordController;
use Sosupp\SlimerTenancy\Http\Controllers\Slimer\Landlord\Auth\LandlordPasswordResetLinkController;
use Sosupp\SlimerTenancy\Http\Controllers\Slimer\Landlord\Auth\LandlordVerifyEmailController;

Route::middleware('guest:landlord')->group(function () {
    Route::get('/login', [LandlordAuthController::class, 'showLoginForm'])->name('landlord.login');

    Route::post('/login', [LandlordAuthController::class, 'login'])->name('landlord.login.store');

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

Route::middleware('auth:landlord')->group(function () {
    Route::get('/', LandlordHome::class)->name('landlord.home');

    Route::get('/dashboard', LandlordHome::class)
    ->name('landlord.dashboard');

    Route::get('/tenants', TenantList::class)
    ->name('landlord.tenants.index');

    Route::get('/blog-list', BlogsList::class )->name('landlord.blogs.index');
    Route::get('/blog/create/{blog?}', BlogMake::class )->name('landlord.blog.make');

});

Route::controller(DemoAccountController::class)->group(function () {
    Route::get('/demo-account/{token?}', 'index')->name('site.demo.index');
});

Route::controller(BlogController::class)->group(function(){
    Route::get('blog/{blog}/banner', 'banner')
    ->name('blog.banner');

    Route::get('blog', 'index')
    ->name('blog.index');

    Route::get('blog/all', 'index')
    ->name('blog.all');

    Route::get('blog/{blog}', 'show')
    ->name('blog.show');

});

Route::controller(FaqController::class)->group(function(){
    Route::get('/faqs', 'index')->name('faq.index');
});
