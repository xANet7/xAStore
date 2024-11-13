<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function() {
    Route::get('/', App\Livewire\Dashboard\Index::class)->name('index');
    Route::prefix('products')->name('product.')->group(function() {
        Route::get('/', App\Livewire\Product\Index::class)->name('index');
        Route::get('/create', App\Livewire\Product\Create::class)->name('create');
        Route::get('/{id}/edit', App\Livewire\Product\Edit::class)->name('edit');
    });
});
