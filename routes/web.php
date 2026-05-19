<?php

use App\Http\Controllers\FuncionController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\ReservaController;
use Illuminate\Support\Facades\Route;

// Dashboard (página principal para empleados)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Redireccionar raíz al dashboard
Route::redirect('/', '/dashboard');

// Recursos principales
Route::resource('peliculas', PeliculaController::class);
Route::resource('funciones', FuncionController::class);

// Reservas
Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
Route::put('/reservas/{id}/cancelar', [ReservaController::class, 'cancelar'])->name('reservas.cancelar');
Route::post('/validar-reserva', [ReservaController::class, 'validar'])->name('validar.reserva');

// Funciones adicionales
Route::get('/funciones/{id}/reservar', [FuncionController::class, 'reservar'])->name('funciones.reservar');
Route::post('/funciones/{id}/procesar-reserva', [FuncionController::class, 'procesarReserva'])->name('funciones.procesarReserva');

//  Para ver detalles de una reserva específica
Route::get('/reservas/{id}', [ReservaController::class, 'show'])->name('reservas.show');