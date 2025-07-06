<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index']);
Route::get('/pinjaman/create/{alat_id}', [PinjamanController::class, 'create'])->name('pinjaman.create');
Route::post('/pinjaman/store', [PinjamanController::class, 'store'])->name('pinjaman.store');

Route::get('/dashboard', function () {
    return redirect()->route('alat.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('alat', AlatController::class);
    Route::resource('pinjaman', PinjamanController::class)->except(['store', 'create']);
});

require __DIR__.'/auth.php';
