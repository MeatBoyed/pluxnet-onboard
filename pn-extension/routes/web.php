<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EasyPayController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Customers
Route::get("/customer", [CustomerController::class, 'view'])->name('customer.view');
Route::post('/customer/register', [CustomerController::class, 'register'])->name('customer.register');
Route::get('/customer/success', [CustomerController::class, 'success'])->name('customer.success');

// EasyPay
Route::get("/easypay", [EasyPayController::class, 'view'])->name('easypay.view');
Route::post("/easypay/generate", [EasyPayController::class, 'generate'])->name('easypay.generate');
Route::get('/easypay/success', [EasyPayController::class, 'success'])->name('easypay.success');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
