<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\VehiculoController;
use \App\Http\Controllers\AlquilerController;
use \App\Http\Controllers\ClienteController;
use \App\Http\Controllers\UsuarioController;
use \App\Http\Controllers\EmpleadoController;



//Ruta de acceso principal
Route::view('/', "public/home")->name('home');

//Ruta de acceso público
Route::get('/documentacion', function () {
    return response()->file(public_path('documentacion.pdf'), ['content-type' => 'application/pdf']);
})
    ->name("documentacion");

Route::view("/condiciones", "public/condiciones")->name('condiciones');
Route::view("/contacto", "public/contacto")->name('contacto');
Route::get("/catalogo", [VehiculoController::class, "search"])->name('catalogo');
Route::post("/catalogo", [AlquilerController::class, "store"])->name('alquiler.store')->middleware("can:doesntHaveAlquiler");
Route::get("/catalogo/vehiculo-{id}", [VehiculoController::class, "mostrar"])->name('vehiculo.mostrar');


// Rutas de inicio, registro y logout
Route::view('login', "public/login")->name('login')->middleware("guest");
Route::post('login', [UsuarioController::class, "authenticate"])->middleware("guest");;
Route::view('register', "public/register")->name('register')->middleware("guest");
Route::post('register', [ClienteController::class, "store"])->middleware("guest");;
Route::get('/logout', [UsuarioController::class, 'logout'])->name('logout')->middleware("auth");



//Lista de rutas de todos los usuarios

Route::middleware("can:isClient")->prefix('client')->group(function () {

    Route::prefix('edit')->group(function () {

        Route::put("/updateProfile", [ClienteController::class, 'updateProfile'])
            ->name('cliente.update.profile');
        Route::put("/updatePassword", [ClienteController::class, 'updatePassword'])
            ->name('cliente.update.password');
        Route::put("/updateImage", [ClienteController::class, 'updateImage'])
            ->name('cliente.update.image');
        Route::get("/profile", [ClienteController::class, 'editProfile'])
            ->name('cliente.edit.profile');
        Route::get("/password", [ClienteController::class, 'editPassword'])
            ->name('cliente.edit.password');
    });

    Route::get("/alquiler", [AlquilerController::class, 'mostrar'])->name('cliente.alquiler');
});


    //Lista de todas las rutas para Empleados y admin
    
    Route::middleware("can:isEmpleadoOrAdmin")->prefix("management")->group(function () {

    Route::resource('vehiculo', VehiculoController::class)->except("mostrar");

    Route::get('/alquiler/all', [AlquilerController::class, "mostrarAlquilerdelaño"])
        ->name("alquiler.year");

    Route::post('/alquiler', [AlquilerController::class, "mostrarAlquileresMensual"])
        ->name("alquiler.month");
});



//Lista de todas las rutas para admin

Route::middleware("can:isAdmin")->prefix("management")->group(function () {

    Route::resource('empleado', EmpleadoController::class)->except("mostrar");

    Route::prefix('cliente')->group(function () {
        Route::get('/all', [ClienteController::class, 'index'])
            ->name('cliente.index');
        Route::post('/delete', [ClienteController::class, "deleteSelected"])
            ->name('cliente.delete');
        Route::post('/delete/all', [ClienteController::class, "deleteAll"])
            ->name('cliente.deleteAll');
            
    });

    Route::get('/estadisticas', [AlquilerController::class, "getEstadisticas"])
        ->name("estadisticas");
});
