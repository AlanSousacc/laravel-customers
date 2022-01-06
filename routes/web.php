<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NumberController;
use App\Http\Controllers\NumberPreferenceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('numbers', NumberController::class)->except(['create', 'show']);
    Route::resource('numbers-preferences', NumberPreferenceController::class)->except(['create', 'show']);
    Route::get('numbers/create/{id?}', [NumberController::class, 'create'])->name('numbers.create');
    Route::get('numbers-preferences/create/{id?}', [NumberPreferenceController::class, 'create'])->name('numbers.preferences.create');
    Route::put('change-status-customer', [CustomerController::class, 'changeStatus'])->name('change.status.customer');
    Route::put('change-status-number', [NumberController::class, 'changeStatus'])->name('change.status.number');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
