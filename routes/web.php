<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// Guest routes (belum login)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Protected routes (sudah login)
Route::middleware(['web'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Customer routes
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('/customers/data', [CustomerController::class, 'getCustomers']);
    Route::get('/customers/export', [CustomerController::class, 'export'])->name('customers.export');
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::put('/customers/{custcd}', [CustomerController::class, 'update']);
    Route::delete('/customers/{custcd}', [CustomerController::class, 'destroy']);
    
    // Product routes
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/products/data', [ProductController::class, 'getProducts']);
    Route::get('/products/export', [ProductController::class, 'export'])->name('products.export');
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    
    // Transaction routes
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');
    Route::get('/history', [TransactionController::class, 'history'])->name('history');
    Route::get('/transactions/data', [TransactionController::class, 'getTransactions']);
    Route::get('/transactions/export', [TransactionController::class, 'export'])->name('transactions.export');
    Route::post('/transactions/bulk', [TransactionController::class, 'storeBulk']);
    
    // Redirect root ke dashboard
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
});
