<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('page.landing');
})->name('landing');
Route::post('/check-domain', [\App\Http\Controllers\DomainController::class, 'check']);
Route::get('/checkout/{domain}', [\App\Http\Controllers\CheckoutController::class, 'show']);
Route::post('/checkout/{domain}', [\App\Http\Controllers\CheckoutController::class, 'processCheckout']);
Route::get('/invoice/download/{transactionId}', [\App\Http\Controllers\CheckoutController::class, 'downloadInvoice'])->name('invoice.download');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
