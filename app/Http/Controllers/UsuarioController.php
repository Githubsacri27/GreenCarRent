<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UsuarioController extends Controller
{
    /**
     * Controla el proceso de inicio de sesión de los usuarios y redirige a los usuarios a diferentes áreas de la aplicación según su rol. 
     */
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();


            if (Gate::allows('isAdmin')) :
                return redirect()->route('cliente.index');
            elseif (Gate::allows('isEmpleado')) :
                return redirect()->route('vehiculo.index');
            elseif (Gate::allows('isClient')) :
                return redirect()->route('cliente.edit.profile');
            endif;
        }

        return back()->withErrors(["status" => 'Credenciales incorrectas.']);
    }


    /**
     * Desconecta a un usuario y lo redirige a home.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route("home");
    }
}
