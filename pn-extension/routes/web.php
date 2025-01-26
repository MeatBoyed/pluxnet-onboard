<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Customers
Route::get("/customer", [CustomerController::class, 'view'])->name('customer.view');
Route::post('/customer/register', [CustomerController::class, 'store'])->name('customer.store');
Route::get('/customer/success', [CustomerController::class, 'success'])->name('customer.success');
// Route::get('/customer/success', function () {
//     return view('customer.success'); // Blade file for the success page
// })->name('customer.success');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
