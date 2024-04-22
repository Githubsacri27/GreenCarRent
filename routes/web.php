<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\VehiculoController;

Route::view('/', "public/home")
    ->name('home');

Route::get('/documentacion', function () {
    return response()->file(public_path('documentacion.pdf'),['content-type'=>'application/pdf']);
})
    ->name("documentacion");

Route::view("/condiciones", "public/condiciones")
    ->name('condiciones');

Route::view("/contacto", "public/contacto")
    ->name('contacto');


    Route::get("/catalogo", [VehiculoController::class, "search"])
    ->name('catalogo');

Route::post("/catalogo/libro", [AlquilerController::class, "store"])
    ->name('alquiler.store')->middleware("can:doesntHaveNoleggio");

Route::get("/catalogo/vehiculo-{id}", [VehiculoController::class, "show"])
    ->name('vehiculo.show');



Route::view('login', "public/login")
    ->name('login')->middleware("guest");

Route::post('login', [UsuarioController::class, "authenticate"])
    ->middleware("guest");;

Route::view('register', "public/register")
    ->name('register')->middleware("guest");

Route::post('register', [ClienteController::class, "store"])
    ->middleware("guest");;

Route::get('/logout', [UsuarioController::class, 'logout'])
    ->name('logout')->middleware("auth");

