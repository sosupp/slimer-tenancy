<?php

use Illuminate\Support\Facades\Route;
use Sosupp\SlimerTenancy\Http\Controllers\Slimer\Tenant\PrivateToPublicFileAccessController;

Route::controller(PrivateToPublicFileAccessController::class)->group(function(){
    Route::get('s/images/{path?}', 'image')
    ->where('path', '.*')
    ->name('slimer.private.image');
    
    Route::get('s/docs/{path?}', 'document')
    ->where('path', '.*')
    ->name('slimer.private.document');


});