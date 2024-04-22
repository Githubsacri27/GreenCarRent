<?php

use Illuminate\Support\Facades\Route;

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
