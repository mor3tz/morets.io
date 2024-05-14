<?php

use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
    return view('home');
    })->middleware(['auth', 'verified'])->name('home');
    route::get('/dashboard',[PengajuanController::class, 'index'])->name('dashboard');
    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');
    Route::get('/pengajuan', function () {
        return view('pengajuan.index');
    })->middleware(['role:admin,user'])->name('pengajuan');
    Route::post('pengajuan/store',[PengajuanController::class, 'store'])->middleware(['role:admin,user'])->name('pengajuan.store');
    Route::get('pengajuan/dtail/{id}',[PengajuanController::class, 'show'])->name('pengajuan.show');
    Route::post('pengajuan/update/{id}',[PengajuanController::class, 'approveOrReject'])->name('pengajuan.approve');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

require __DIR__.'/auth.php';
