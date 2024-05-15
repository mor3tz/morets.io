<?php

use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    Route::get('pengajuan/dtail/{id}',[PengajuanController::class, 'show'])->middleware(['role:admin,kabag,vp,avp,svp_operation,svp_security'])->name('pengajuan.show');
    Route::post('pengajuan/update/{id}',[PengajuanController::class, 'approveOrReject'])->middleware(['role:kabag,vp,avp,svp_operation,svp_security'])->name('pengajuan.approve');
    Route::delete('pengajuan/{id}',[PengajuanController::class, 'delete'])->middleware(['role:admin'])->name('pengajuan.delete');

    Route::get('/user', [UserController::class, 'index'])->middleware(['role:admin'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->middleware(['role:admin'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->middleware(['role:admin'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->middleware(['role:admin'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->middleware(['role:admin'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->middleware(['role:admin'])->name('user.destroy');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


// });

require __DIR__.'/auth.php';
