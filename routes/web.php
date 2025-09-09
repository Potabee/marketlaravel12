<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

// routes/web.php

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::post('admin/katbarang/store', [App\Http\Controllers\Admin\KatBarangController::class, 'store'])->name('katbarang.store');
    Route::delete('admin/katbarang/{id}', [App\Http\Controllers\Admin\KatBarangController::class, 'destroy'])->name('katbarang.destroy');
    Route::get('admin/katbarang/edit/{id}', [App\Http\Controllers\Admin\KatBarangController::class, 'edit'])->name('katbarang.edit');
    Route::put('admin/katbarang/update/{id}', [App\Http\Controllers\Admin\KatBarangController::class, 'update'])->name('katbarang.update');
    Route::get('admin/katbarang', [App\Http\Controllers\Admin\KatBarangController::class, 'index'])->name('katbarang.index');
    Route::get('admin/dataBarang', [App\Http\Controllers\Admin\DataBarangController::class, 'index'])->name('databarang.index');
    Route::post('admin/dataBarang/store', [App\Http\Controllers\Admin\DataBarangController::class, 'store'])->name('databarang.store');
    Route::get('/databarang/generate-kode', [App\Http\Controllers\Admin\DataBarangController::class, 'generateKode'])->name('databarang.generateKode');
    Route::get('admin/dataBarang/edit/{id}', [App\Http\Controllers\Admin\DataBarangController::class, 'edit'])->name('databarang.edit');
    Route::put('admin/dataBarang/update/{id}', [App\Http\Controllers\Admin\DataBarangController::class, 'update'])->name('databarang.update');
    Route::delete('admin/dataBarang/{id}', [App\Http\Controllers\Admin\DataBarangController::class, 'destroy'])->name('databarang.destroy');
});

require __DIR__ . '/auth.php';
