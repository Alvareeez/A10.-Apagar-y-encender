<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

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
