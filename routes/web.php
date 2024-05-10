<?php

use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});


// home routes
Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');



route::get('/dashboard',[PengajuanController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/pengajuan', function () {
    return view('pengajuan.index');
})->middleware(['auth', 'verified'])->name('pengajuan');


//contact routes
Route::get('/contact', function () {
    return view('contact');
})->middleware(['auth', 'verified'])->name('contact');

Route::post('pengajuan/store',[PengajuanController::class, 'store'])->middleware(['auth', 'verified'])->name('pengajuan.store');
Route::get('pengajuan/dtail/{id}',[PengajuanController::class, 'show'])->middleware(['auth', 'verified'])->name('pengajuan.show');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //dashboard routes
   

    // pengajuan routes
    
});

require __DIR__.'/auth.php';
