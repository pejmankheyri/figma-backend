<?php
use Illuminate\Support\Facades\Route;


// Route group for authenticater users only
Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout', [
        App\Http\Controllers\Auth\LoginController::class, 'logout'
    ]);
});


// Route group for guests only
Route::group(['middleware' => ['guest:api']], function () {
    Route::post('register', [
        App\Http\Controllers\Auth\RegisterController::class, 'register'
    ]);

    Route::post('login', [
        App\Http\Controllers\Auth\LoginController::class, 'login'
    ]);
});
