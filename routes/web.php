<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\GestorController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\UserController;

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
    Route::get('/gestor/incidencias', [GestorController::class, 'incidencias'])->name('gestor.incidencias');
    Route::post('/gestor/incidencia/{id}/asignar', [GestorController::class, 'asignarTecnico'])->name('gestor.incidencia.asignar');
    Route::get('/gestor/tecnicos', [GestorController::class, 'tecnicos'])->name('gestor.tecnicos');
    Route::get('/gestor/tecnico/{id}/incidencias', [GestorController::class, 'incidenciasTecnico'])->name('gestor.incidencias_tecnico');
    Route::get('/gestor/incidencia/{id}', [GestorController::class, 'detallesIncidencia'])->name('gestor.detalles_incidencia');
    Route::get('/gestor/perfil', [GestorController::class, 'perfil'])->name('gestor.perfil');
    Route::put('/gestor/perfil', [GestorController::class, 'updateProfile'])->name('gestor.perfil.update');
    
    // TECNICO
    Route::get('/tecnico/dashboard', [TecnicoController::class, 'dashboard'])->name('tecnico.dashboard');
    Route::get('/home', function () {
        return view('home'); // Página por defecto
    })->name('home');
});

Route::get('crearincidencias', [IncidenciaController::class, 'create'])->name('incidencias.create');
Route::post('incidencias', [IncidenciaController::class, 'store'])->name('incidencias.store');
Route::get('misincidencias', [IncidenciaController::class, 'index'])->name('incidencias.index');
Route::get('/incidencias/chat/{id}', [IncidenciaController::class, 'chat'])->name('incidencias.chat');
Route::post('/incidencias/chat/{id}', [IncidenciaController::class, 'sendMessage'])->name('incidencias.sendMessage');

Route::get('/perfil', [ClienteController::class, 'showProfile'])->name('perfil.show');
Route::put('/perfil', [ClienteController::class, 'updateProfile'])->name('perfil.update');
