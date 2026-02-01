<?php

use App\Http\Controllers\atendimentoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\serviceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [dashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Clients
Route::middleware(['auth'])->group(function () {

    Route::get('/clients', [clientController::class, 'index'])->name('clients.index');
    Route::get('/client-create', [clientController::class, 'create'])->name('clients.create');
    Route::post('/clients-store', [clientController::class, 'store'])->name('clients.store');

    Route::get('/client-edit/{id}', [clientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients-update', [clientController::class, 'update'])->name('clients.update');

    Route::delete('/client-destroy/{id}/', [clientController::class, 'destroy'])->name('clients.destroy');
});

// Model Service
Route::middleware(['auth'])->group(function () {

    Route::get('/service', [serviceController::class, 'index'])->name('service.index');
    Route::get('/service-create', [serviceController::class, 'create'])->name('service.create');
    Route::post('/service-store', [serviceController::class, 'store'])->name('service.store');

    Route::get('/service-edit/{id}', [serviceController::class, 'edit'])->name('service.edit');
    Route::put('/service-update', [serviceController::class, 'update'])->name('service.update');

    Route::delete('/service-destroy/{id}/', [serviceController::class, 'destroy'])->name('service.destroy');
});


// atendimento atendimento
Route::middleware(['auth'])->group(function () {

    Route::get('/atendimento', [atendimentoController::class, 'index'])->name('atendimento.index');

    Route::get('/appointments/create', [atendimentoController::class, 'create'])->name('appointments.create');
    Route::post('/store', [atendimentoController::class, 'store'])->name('appointments.store');
    Route::delete('/destroy/{id}', [atendimentoController::class, 'destroy'])->name('appointments.destroy');
});
require __DIR__ . '/auth.php';
