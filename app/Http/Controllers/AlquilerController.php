<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use App\Models\Vehiculo;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;

/**
 * Controlador para gestionar alquileres de vehículos.
 */
class AlquilerController extends Controller
{
    /**
     * Muestra los detalles de la página del Alquiler para el cliente autenticado.
     *
     * @return \Illuminate\View\View Vista de detalles del alquiler para el cliente.
     */
    public function mostrar(){
        $alquiler = Alquiler::where("clienteID", Auth::user()->utenteable->id)->where("activo", true)->first();
        return view("cliente.cliente-alquiler", ["alquiler" => $alquiler]);
    }

    /**
     * Guarda un nuevo alquiler en la base de datos.
     *
     * @param \Illuminate\Http\Request $request Datos de la solicitud de alquiler.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la vista de catálogo con un mensaje de éxito o error.
     */
    public function store(Request $request){

        if (Gate::denies('doesntHaveAlquiler')) {
            return redirect()->route('catalogo')->withErrors(['error' => '¡Ya tienes un alquiler activo! Solo se permite un alquiler por cliente.']);
        }
        if (Gate::allows("doesntHaveAlquiler")) {
            // Verifica si las propiedades existen en el request antes de descifrarlas
            if (
                $request->has('id') && $request->has('fechaRecogida') && $request->has('lugarRecogida') &&
                $request->has('horaRecogida') && $request->has('fechaEntrega') && $request->has('lugarEntrega') &&
                $request->has('horaEntrega')
            ) {

                $request['id'] = Crypt::decrypt($request['id']);
                $request['fechaRecogida'] = Crypt::decrypt($request['fechaRecogida']);
                $request['lugarRecogida'] = Crypt::decrypt($request['lugarRecogida']);
                $request['horaRecogida'] = Crypt::decrypt($request['horaRecogida']);
                $request['fechaEntrega'] = Crypt::decrypt($request['fechaEntrega']);
                $request['lugarEntrega'] = Crypt::decrypt($request['lugarEntrega']);
                $request['horaEntrega'] = Crypt::decrypt($request['horaEntrega']);

                $vehiculo = Vehiculo::find($request->id);
                if ($vehiculo) {
                    $importe = $vehiculo->costoDiario * date_diff(date_create($request->fechaRecogida), date_create($request->fechaEntrega))->days;

                    $vehiculo->alquiler()->create([
                        "clienteID" => Auth::user()->utenteable->id,
                        "fechaRecogida" => $request->fechaRecogida,
                        "lugarRecogida" => $request->lugarRecogida,
                        "horaRecogida" => $request->horaRecogida,
                        "fechaEntrega" => $request->fechaEntrega,
                        "lugarEntrega" => $request->lugarEntrega,
                        "horaEntrega" => $request->horaEntrega,
                        "importe" => $importe,
                        "activo" => true
                    ]);

                    return redirect()->route("catalogo")->with("success", "¡Reserva realizada con éxito!");
                } else {
                    return redirect()->route("catalogo")->withErrors("error", "Vehículo no encontrado");
                }
            } else {
                return redirect()->route("catalogo")->withErrors("error", "Datos de solicitud incompletos");
            }
        } else {
            return redirect()->route("catalogo")->withErrors("error", "Reserva imposible");
        }
    }

    /**
     * Muestra la lista de alquileres para el año actual.
     *
     * @return \Illuminate\View\View Vista de la lista de alquileres para el año actual.
     */

    public function mostrarAlquilerdelaño()
    {
        $alquileres = Alquiler::all();
        return view('empleado.alquiler-index', ['alquileres' => $alquileres]);
    }


    /**
     * Devuelve la lista de alquileres para el año actual y el mes seleccionado presente en la base de datos.
     *
     * @param int $month Mes para filtrar los alquileres.
     * @return \Illuminate\Support\Collection Colección de alquileres.
     */
    public function obtenerAlquilerMensual($month)
    {
        $year = Carbon::today()->year;
        $startDate = Carbon::parse($year . "-" . $month)->startOfMonth()->format("Y-m-d");
        $endDate = Carbon::parse($year . "-" . $month)->endOfMonth()->format("Y-m-d");

        return Alquiler::whereBetween("fechaRecogida", [$startDate, $endDate])
            ->orWhereBetween("fechaEntrega", [$startDate, $endDate])
            ->orWhere(function ($query) use ($startDate, $endDate) {
                $query->where("fechaRecogida", "<", $startDate)->where("fechaEntrega", ">", $endDate);
            })
            ->get();
    }

    /**
     * Muestra la lista de alquileres para el año actual y el mes seleccionado.
     *
     * @param \Illuminate\Http\Request $request Datos de la solicitud.
     * @return \Illuminate\View\View Vista de la lista de alquileres.
     */
    public function mostrarAlquileresMensual(Request $request)
    {
        $mes = $request->input('mes');
        $alquileres = Alquiler::when($mes > 0, function ($query) use ($mes) {
            return $query->whereMonth('fechaRecogida', $mes);
        })->get();

        return view('empleado.alquiler-index', ['alquileres' => $alquileres]);
    }

    /**
     * Muestra la página con estadísticas del número total de alquileres para cada mes del año actual.
     *
     * @return \Illuminate\View\View Vista con estadísticas.
     */
    public function getEstadisticas()
    {
        $array = [];
        for ($month = 1; $month <= 12; $month++) {
            $array[$month - 1] = count($this->obtenerAlquilerMensual($month));
        }

        return view("admin.estadisticas", ["value" => $array]);
    }
}
