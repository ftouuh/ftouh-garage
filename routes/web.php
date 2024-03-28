<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/users', [AdminController::class, 'showUsers'])->middleware(['auth', 'verified'])->name('admin.users');
    Route::get('/mechanics',[AdminController::class , 'showMechanics'])->name('admin.mechanics');
    Route::get('/admins',[AdminController::class , 'showAdmins'])->name('admin.admins');


    Route::delete('/dashboard/{client}/destroy', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/dashboard/{client}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/dashboard/{client}/update', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/profile/{client}', [AdminController::class, 'showProfile'])->name('admin.show-profile');
    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');



});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
