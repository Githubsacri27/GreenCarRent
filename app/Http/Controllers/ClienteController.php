<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ClienteController extends Controller
{
    /**
     * Muestra la lista de clientes
     */
    public function index(Request $request){
        $clientes = Cliente::paginate(10);

        if($request->ajax()){
            return view('admin.client-table', compact('clientes'))->render();
        }
        else {
            return view('admin.cliente-index',compact('clientes'));
        }
    }


    /**
     * Muestra el formulario de login.
     */
    public function create(){
        return view("public.login");
    }


    /**
     * Guardar un nuevo cliente en la base de datos
     */
    public function store(Request $request) {

        $request->validate([
            'nombre' => 'required|alpha:ascii|max:30',
            'apellidos' => 'required|alpha:ascii|max:30',
            'domicilio' => 'required|string|max:50',
            'ocupacion' => ['required', Rule::in(['No especificado', 'Empleado', 'Autonomo', 'Estudiante', 'Desempleado'])],
            'fechaNacimiento' => 'required|date|before: -19 years|after: -75 years|size:10',
            'username' => 'required|alpha_dash|min:8|max:30|unique:usuario,username',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'password_confirmation' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $foto = "storage/avatar.png";

        $cliente = Cliente::create(array_merge($request->only("nombre", "apellidos", "domicilio", "ocupacion", "fechaNacimiento"), ["foto" => $foto]));


        $usuario = $cliente->usuario()->create($request->only("username", "password"));

        if ($request->hasFile("foto")) {
            $foto = StorageController::storeImage($request->file("foto"), $cliente->id, "cliente");
            $cliente->update(["foto" => $foto]);
        }

        Auth::login($usuario);

        return redirect()->route("cliente.edit.profile");
    }


    /**
     * Muestra la vista donde el cliente puede editar la información personal.
     */
    public function editProfile()
    {
        return view("cliente.cliente-edit-profile");
    }

    /**
     * Muestra la vista donde puede cambiar la contraseña el cliente.
     */
    public function editPassword(){
        return view("cliente.cliente-edit-password");
    }


    /**
     * Actualiza la información personal del cliente.
     */
    public function updateProfile(Request $request){
        $request->validate([
            'nombre' => 'required|alpha:ascii|max:30',
            'apellidos' => 'required|alpha:ascii|max:30',
            'username' => ['required', 'alpha_dash', 'min:8', 'max:30', Rule::unique("usuario", "username")->ignore(Auth::user())],
            'domicilio' => 'required|string|max:50',
            'ocupacion' => ['required', Rule::in(['No especificado', 'Empleado', 'Autonomo', 'Estudiante', 'Desempleado'])],
            'fechaNacimiento' => 'required|date|before: -19 years|after: -75 years|size:10',
        ]);
        
        Auth::user()->utenteable->update($request->except("username"));
        return redirect()->back()->with('success','Datos actualizados correctamente');
    }


    /**
     * Actualizar la contraseña del cliente
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required|current_password',
            'password' => ['required', 'confirmed', 'different:oldPassword', Password::min(8)->mixedCase()->numbers()],
            'password_confirmation' => 'required'
        ]);
        //Auth::user()->update(["password" => $request->password]);
        Auth::user()->utenteable->update($request->except("password"));
        return redirect()->back()->with('success','Contraseña actualizada correctamente');
    }


    /**
     * Actualiza la foto de perfil del cliente.
     */
    public function updateImage(Request $request) {

        $request->validate([
            'foto' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $foto = StorageController::updateImage($request->file("foto"), Auth::user()->utenteable->id, "cliente");
        Auth::user()->utenteable->update(["foto" => $foto]);
        return redirect()->back()->with('success','Foto de perfil actualizada correctamente');
    }


    /**
     * Eliminar los clientes seleccionados
     */
    public function deleteSelected(Request $request){
    $ids = $request->input('ids');
    if (is_array($ids)) {
        Usuario::where("utenteable_type", "App\Models\Cliente")->whereIn("utenteable_id", $ids)->delete();
        Cliente::whereIn("id", $ids)->delete();
        foreach ($ids as $id) {
            StorageController::findAndDeleteImage($id, "cliente");
        }
        return response()->json(['url' => route("cliente.index")]);
    }

    $id = $request->input('id');
    if ($id) {
        Usuario::where("utenteable_type", "App\Models\Cliente")->where("utenteable_id", $id)->delete();
        Cliente::where("id", $id)->delete();
        StorageController::findAndDeleteImage($id, "cliente");
        return response()->json(['url' => route("cliente.index")]);
    }

    return response()->json(['error' => 'No se proporcionaron IDs'], 400);
}

    /**
     * Elimina todos los clientes
     */
    public function deleteAll(){
        Usuario::where("utenteable_type", "App\Models\Cliente")->delete();
        DB::table('cliente')->delete();
        StorageController::deleteDirectory(public_path("storage/cliente"));
        return redirect()->route("cliente.index");
    }
}
