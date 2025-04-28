<?php

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UniqueLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegistrationController::class, 'showForm']);
Route::post('/register', [RegistrationController::class, 'register'])->name('register');

Route::prefix('link')->name('link.')->group(function () {
    Route::controller(UniqueLinkController::class)->group(function () {
        Route::get('/{uuid}', 'show')->name('show');
        Route::post('/{uuid}/regenerate', 'regenerate')->name('regenerate');
        Route::post('/{uuid}/deactivate', 'deactivate')->name('deactivate');
        Route::post('/{uuid}/lucky', 'lucky')->name('lucky');
        Route::get('/{uuid}/history', 'history')->name('history');
    });
});
