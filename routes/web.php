<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');
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
});
