<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\GestorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\TecnicoController;

// Ruta para la página de inicio de sesión
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Ruta para la página de inicio después de loguearse
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Ruta por defecto que redirige a /home si estás autenticado
Route::redirect('/', '/login');

// Ruta para cerrar sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Redireccion inicial al login
Route::get('/', IndexController::class);

// Route::middleware(['auth'])->group(function () {
Route::get('/admin', [UserController::class, 'index'])->name('admin');
/* Rutas para el crud de usuarios */
Route::controller(UserController::class)->group(function () {
    Route::get('usuarios', 'index')->name('usuarios.index');
    /* METODOS INSERT*/
    Route::get('usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
    Route::post('usuarios', [UserController::class, 'store'])->name('usuarios.store');

    /* METODOS EDIT*/
    Route::get('usuarios/{usuario}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');


    /* METODO DELETE */
    Route::delete('usuarios/{usuario}', [UserController::class, 'destroy'])->name('usuarios.destroy');
});
// });
// Rutas según el rol
Route::middleware('auth')->group(function () {
    // CLIENTE
    Route::get('/cliente/dashboard', [ClienteController::class, 'dashboard'])->name('cliente.dashboard');

    // GESTOR
    Route::get('/gestor/dashboard', [GestorController::class, 'dashboard'])->name('gestor.dashboard');
    Route::get('/gestor/incidencias', [GestorController::class, 'incidencias'])->name('gestor.incidencias');
    Route::post('/gestor/incidencia/{id}/asignar', [GestorController::class, 'asignarTecnico'])->name('gestor.incidencia.asignar');
    Route::get('/gestor/tecnicos', [GestorController::class, 'tecnicos'])->name('gestor.tecnicos');
    Route::get('/gestor/tecnico/{id}/incidencias', [GestorController::class, 'incidenciasTecnico'])->name('gestor.incidencias_tecnico');
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
