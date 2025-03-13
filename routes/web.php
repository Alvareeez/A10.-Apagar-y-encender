<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\GestorController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\IncidenciaController;

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas según el rol
Route::middleware('auth')->group(function () {
    // ADMIN
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // CLIENTE
    Route::get('/cliente/dashboard', [ClienteController::class, 'dashboard'])->name('cliente.dashboard');

    // GESTOR
    Route::get('/gestor/dashboard', [GestorController::class, 'dashboard'])->name('gestor.dashboard');
    Route::post('/gestor/incidencia/{id}/asignar', [GestorController::class, 'asignarTecnico'])->name('gestor.incidencia.asignar');
    Route::get('/gestor/tecnicos', [GestorController::class, 'tecnicos'])->name('gestor.tecnicos'); // Añadir esta línea
    
    // TECNICO
    Route::get('/tecnico/dashboard', [TecnicoController::class, 'dashboard'])->name('tecnico.dashboard');
    Route::get('/home', function () {
        return view('home'); // Página por defecto
    })->name('home');
});

Route::get('crearincidencias', [IncidenciaController::class, 'create'])->name('incidencias.create');
Route::post('incidencias', [IncidenciaController::class, 'store'])->name('incidencias.store');
Route::get('misincidencias', [IncidenciaController::class, 'index'])->name('incidencias.index');
