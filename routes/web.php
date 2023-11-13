<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', [PaymentController::class, 'index'])->name('index');
Route::post('/checkout', [PaymentController::class, 'handlePayment'])->name('checkout');
