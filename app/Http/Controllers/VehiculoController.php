<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;

class VehiculoController extends Controller
{
    /**
     * Muestra la página con los detalles del vehiculo
     */
    public function show($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        return view("public/vehiculo-show", ["vehiculo" => $vehiculo]);
    }
    /**
     * Muestra la lista de vehiculos en la base de datos
     */
    public function index()
    {
        return view("empleado.vehiculo-index", ["vehiculo" => Vehiculo::paginate(10)]);
    }


   
}
