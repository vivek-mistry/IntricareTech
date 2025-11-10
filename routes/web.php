<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('practical_1');
})->name('practical_1');

Route::get('/practical_2', function () {
    return view('practical_2');
})->name('practical_2');


/**
 * Contacts ROUTES
 */
Route::prefix('/contact')->group(function () {
    Route::post('/list', [ContactController::class, 'index'])->name('contact.list');
    Route::post('/store', [ContactController::class, 'store'])->name('contact.store');
});