<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


/**
 * Contacts ROUTES
 */
Route::prefix('/')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('contact.list');
    Route::post('/ajax/list', [ContactController::class, 'ajaxList'])->name('contact.ajax.list');
    Route::post('/store', [ContactController::class, 'store'])->name('contact.store');
    Route::delete('/destroy/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');
    Route::get('/edit/{contact}', [ContactController::class, 'edit'])->name('contact.edit');
    Route::post('/update/{contact}', [ContactController::class, 'update'])->name('contact.update');
    Route::get('/dropdown/{id}', [ContactController::class, 'dropdown'])->name('contact.dropdown');
    Route::post('/merge', [ContactController::class, 'contactMerge'])->name('contact.merge');
});