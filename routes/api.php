<?php
use Illuminate\Support\Facades\Route;

Route::get('me', [
    App\Http\Controllers\MeController::class, 'getMe'
]);

// Route group for authenticater users only
Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout', [
        App\Http\Controllers\Auth\LoginController::class, 'logout'
    ]);

    Route::get('brands', [
        App\Http\Controllers\BrandController::class, 'index'
    ]);
    Route::post('brand', [
        App\Http\Controllers\BrandController::class, 'store'
    ]);
    Route::put('brand/{id}', [
        App\Http\Controllers\BrandController::class, 'update'
    ]);
    Route::delete('brand/{id}', [
        App\Http\Controllers\BrandController::class, 'destroy'
    ]);

    Route::get('brand/{id}/models', [
        App\Http\Controllers\CmodelController::class, 'index'
    ]);
    Route::post('model', [
        App\Http\Controllers\CmodelController::class, 'store'
    ]);
    Route::put('model/{id}', [
        App\Http\Controllers\CmodelController::class, 'update'
    ]);
    Route::delete('model/{id}', [
        App\Http\Controllers\CmodelController::class, 'destroy'
    ]);

    Route::get('search', [
        App\Http\Controllers\CmodelController::class, 'search'
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
