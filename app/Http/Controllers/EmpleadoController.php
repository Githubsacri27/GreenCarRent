<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class EmpleadoController extends Controller
{
    /**
     * Muestra la lista de empleados.
     */
    public function index(){
        return view("admin.empleado-index", ["empleados" => Empleado::paginate(10)]);
    }


    /**
     * Muestra el formulario para crear un nuevo empleado
     */
    public function create(){
        return view("admin.empleado-create");
    }


    /**
     * Guarda un nuevo empleado en BD.
     */
    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|alpha:ascii|max:30',
            'apellidos' => 'required|alpha:ascii|max:30',
            'username' => 'required|alpha_dash|min:8|max:30|unique:usuario,username',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'password_confirmation' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $foto = "storage/avatar.png";

        $empleado = Empleado::create(array_merge($request->only("nombre", "apellidos"), ["foto" => $foto]));


        $empleado->usuario()->create($request->only("username", "password"));

        if ($request->hasFile("foto")) {
            $foto = StorageController::storeImage($request->file("foto"), $empleado->id, "empleado");
            $empleado->update(["foto" => $foto]);
        }

        return redirect()->route("empleado.index");
    }


    /**
     * Muestra el formulario para modificar empleados
     */
    public function edit($id)
    {
        return view("admin.empleado-edit", ["empleado" => Empleado::find($id)]);
    }


    /**
     * Actualiza y guarda los nuevos datos de empleados en BD
     */
    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'nombre' => 'required|alpha:ascii|max:30',
            'apellidos' => 'required|alpha:ascii|max:30',
            'username' => ["required", 'alpha_dash', "min:8", "max:30",  Rule::unique('usuario', 'username')->ignore($empleado->usuario)],
            'password' => ['nullable', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->filled("password")) {
            $request->validate([
                'password_confirmation' => 'required'
            ]);
            $empleado->usuario->update($request->only("password"));
        }

        $empleado->usuario->update($request->only("username"));

        $empleado->update($request->only("nombre", "apellidos"));

        if ($request->hasFile("foto")) {
            $foto = StorageController::updateImage($request->file("foto"), $empleado->id, "empleado");
            $empleado->update(["foto" => $foto]);
        }

        return redirect()->route("empleado.index");
    }


    /**
     * Elimina el empleado de la BD.
     */
    public function destroy(Empleado $empleado)
    {
        StorageController::FindAndDeleteImage($empleado->id, "empleado");
        $empleado->usuario->delete();
        $empleado->delete();
        return redirect()->route("empleado.index");
    }
}
