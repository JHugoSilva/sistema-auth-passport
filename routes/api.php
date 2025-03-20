<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::controller(AuthController::class)->group(function(){
    Route::prefix('auth')->name('auth')->group(function(){
        Route::post('register', 'register')->name('register');
        Route::post('login', 'login')->name('login');

        Route::middleware(['auth:api'])->group(function(){
            Route::get('profile', 'profile')->name('profile');
            Route::delete('logout', 'logout')->name('logout');
        });
    });
});
