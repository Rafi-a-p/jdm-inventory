<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Sparepart CRUD Routes
    Route::resource('spareparts', SparepartController::class);
    Route::get('/spareparts/{sparepart}/stock-card', [SparepartController::class, 'stockCard'])
        ->name('spareparts.stock-card');

    // Category CRUD Routes
    Route::resource('categories', CategoryController::class)->except(['show']);

    // Transaction Routes
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/masuk', [TransactionController::class, 'createMasuk'])->name('transactions.create.masuk');
    Route::post('/transactions/masuk', [TransactionController::class, 'storeMasuk'])->name('transactions.store.masuk');
    Route::get('/transactions/keluar', [TransactionController::class, 'createKeluar'])->name('transactions.create.keluar');
    Route::post('/transactions/keluar', [TransactionController::class, 'storeKeluar'])->name('transactions.store.keluar');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');

    // Report Routes
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/stock', [ReportController::class, 'stockReport'])->name('reports.stock');
    Route::get('/reports/transactions', [ReportController::class, 'transactionReport'])->name('reports.transactions');
    Route::get('/reports/stock-card/{sparepart}', [ReportController::class, 'stockCard'])->name('reports.stock-card');

    // Export Routes
    Route::get('/export/spareparts', [ExportController::class, 'spareparts'])->name('export.spareparts');
    Route::get('/export/transactions', [ExportController::class, 'transactions'])->name('export.transactions');
});

require __DIR__.'/auth.php';

