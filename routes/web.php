<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

// Ruta para la página de inicio de sesión
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Ruta para la página de inicio después de loguearse
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Ruta por defecto que redirige a /home si estás autenticado
Route::redirect('/', '/home');

// Ruta para cerrar sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');