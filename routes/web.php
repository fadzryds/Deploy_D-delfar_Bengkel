<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HistorySparepartController;
use App\Http\Controllers\HistoryServiceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\SparepartCheckoutController;
use App\Http\Controllers\SparepartOrderController;
use App\Http\Controllers\CheckoutSparepartController;
use App\Http\Controllers\CartController;

// Landing Page
Route::get('/', [SparepartController::class, 'landing'])->name('landing');

// ================= AUTH =================

// LOGIN (HANYA UNTUK GUEST)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// LOGOUT (HANYA USER LOGIN)
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('landing');
})->name('logout');

// ================= USER =================
Route::middleware('auth')->group(function () {
    // Tampilkan profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

    // Update profile
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Halaman lain
Route::get('/sparepart', [SparepartController::class, 'index'])->name('sparepart');
Route::middleware('auth')->get('/historyservice', [HistoryServiceController::class, 'index'])
    ->name('historyservice')
    ->middleware('auth');
Route::middleware('auth')->get('/historysparepart', [HistorySparepartController::class, 'index'])
    ->name('historysparepart')
    ->middleware('auth');


// Detail sparepart
Route::get('/sparepart/{id}', [SparepartController::class, 'show'])->name('sparepart.show');

// Halaman service
Route::get('/service', function () {
    return view('landing.Service');
})->name('service');

// Halaman antrian
Route::get('/antrian', function () {
    return view('landing.antrian');
})->name('antrian');

// Routes untuk Booking
Route::resource('bookings', BookingController::class);

// Halaman invoice (hanya user login)
Route::middleware('auth')->get('/invoice/{invoice}', [InvoiceController::class, 'show'])->name('invoice.show');

// ================= CART =================
Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/delete', [CartController::class, 'delete'])->name('cart.delete');
    Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
});

// ================= CHECKOUT SPAREPART =================
Route::middleware('auth')->group(function () {

    // 1️⃣ halaman checkout (GET)
    Route::get('/checkout/sparepart',
        [CheckoutSparepartController::class, 'index']
    )->name('checkout.sparepart');

    // 2️⃣ proses ke halaman konfirmasi (POST)
    Route::post('/checkout/sparepart/confirm',
        [CheckoutSparepartController::class, 'confirm']
    )->name('checkout.sparepart.confirm');

    // 3️⃣ simpan ke database (POST)
    Route::post('/checkout/sparepart/store',
        [CheckoutSparepartController::class, 'store']
    )->name('checkout.sparepart.store');
});