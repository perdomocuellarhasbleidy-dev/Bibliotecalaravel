<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DevolucionController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\MultaController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/',
    fn () => redirect()->route('login')
);

Route::get(
    '/login',
    [AuthController::class, 'showLogin']
)->name('login');

Route::post(
    '/login',
    [AuthController::class, 'login']
)->name('login.store');

Route::post(
    '/logout',
    [AuthController::class, 'logout']
)->name('logout');


/*
|--------------------------------------------------------------------------
| REGISTRO
|--------------------------------------------------------------------------
*/

Route::get(
    '/registro',
    [UsuarioController::class, 'create']
)->name('registro');

Route::post(
    '/registro',
    [UsuarioController::class, 'store']
)->name('registro.store');


/*
|--------------------------------------------------------------------------
| USUARIOS AUTENTICADOS
|--------------------------------------------------------------------------
*/

Route::middleware(
    'role:bibliotecario,usuario'
)->group(function () {

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

    Route::get(
        '/catalogo',
        [LibroController::class, 'catalogo']
    )->name('catalogo');

    Route::get(
        '/mis-prestamos',
        [PrestamoController::class, 'index']
    )->name('mis-prestamos');
});


/*
|--------------------------------------------------------------------------
| BIBLIOTECARIO
|--------------------------------------------------------------------------
*/

Route::middleware(
    'role:bibliotecario'
)->group(function () {

    Route::resource(
        'libros',
        LibroController::class
    )->except(['show', 'index']);

    Route::get(
        '/libros',
        [LibroController::class, 'catalogo']
    )->name('libros.index');


    /*
    |--------------------------------------------------------------------------
    | USUARIOS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/usuarios',
        [UsuarioController::class, 'index']
    )->name('usuarios.index');

    Route::get(
        '/usuarios/crear',
        [UsuarioController::class, 'createAdmin']
    )->name('usuarios.create');

    Route::post(
        '/usuarios',
        [UsuarioController::class, 'storeAdmin']
    )->name('usuarios.store');

    Route::get(
        '/usuarios/{usuario}/editar',
        [UsuarioController::class, 'edit']
    )->name('usuarios.edit');

    Route::put(
        '/usuarios/{usuario}',
        [UsuarioController::class, 'update']
    )->name('usuarios.update');

    Route::delete(
        '/usuarios/{usuario}',
        [UsuarioController::class, 'destroy']
    )->name('usuarios.destroy');


    /*
    |--------------------------------------------------------------------------
    | PRESTAMOS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/prestamos',
        [PrestamoController::class, 'index']
    )->name('prestamos.index');

    Route::get(
        '/prestamos/crear',
        [PrestamoController::class, 'create']
    )->name('prestamos.create');

    Route::post(
        '/prestamos',
        [PrestamoController::class, 'store']
    )->name('prestamos.store');

    Route::patch(
        '/prestamos/{prestamo}/estado',
        [PrestamoController::class, 'updateEstado']
    )->name('prestamos.estado');

    Route::delete(
        '/prestamos/{prestamo}',
        [PrestamoController::class, 'destroy']
    )->name('prestamos.destroy');


    /*
    |--------------------------------------------------------------------------
    | DEVOLUCIONES
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/devoluciones',
        [DevolucionController::class, 'index']
    )->name('devoluciones.index');

    Route::post(
        '/devoluciones',
        [DevolucionController::class, 'store']
    )->name('devoluciones.store');


    /*
    |--------------------------------------------------------------------------
    | MULTAS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/multas',
        [MultaController::class, 'index']
    )->name('multas.index');

    Route::post(
        '/multas',
        [MultaController::class, 'store']
    )->name('multas.store');

    Route::put(
        '/multas/{multa}',
        [MultaController::class, 'update']
    )->name('multas.update');

    Route::delete(
        '/multas/{multa}',
        [MultaController::class, 'destroy']
    )->name('multas.destroy');
});