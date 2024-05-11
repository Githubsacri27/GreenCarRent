<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use Illuminate\Validation\Rule;

/**
 * Controlador para gestionar los vehículos.
 */
class VehiculoController extends Controller
{
    /**
     * Muestra la página con los detalles de un vehículo específico.
     *
     * @param int $id ID del vehículo a mostrar.
     * @return \Illuminate\View\View Vista con los detalles del vehículo.
     */
    public function mostrar($id){
        $vehiculo = Vehiculo::findOrFail($id);
        return view("public/vehiculo-mostrar", ["vehiculo" => $vehiculo]);
    }

    /**
     * Muestra la lista de vehículos con paginación, limitando los resultados a 10.
     *
     * @return \Illuminate\View\View Vista de la lista de vehículos.
     */
    public function index(){
        $vehiculos = Vehiculo::paginate(10);
        return view("empleado.vehiculo-index", ["vehiculos" => $vehiculos]);
    }

    /**
     * Muestra el formulario para crear un nuevo vehículo.
     *
     * @return \Illuminate\View\View Vista del formulario de creación de un nuevo vehículo.
     */
    public function create(){
        return view("empleado.vehiculo-create");
    }

    /**
     * Guarda un nuevo vehículo en la base de datos.
     *
     * @param \Illuminate\Http.Request $request Solicitud HTTP entrante con los datos del nuevo vehículo.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de vehículos.
     */
    public function store(Request $request){
        // Validación.
        $request->validate([
            'matricula' => 'required|regex:/^\d{4}[a-zA-Z]{3}$/|size:7|unique:vehiculo,matricula',
            'modelo' => 'required|max:100',
            'marca' => 'required|max:30',
            'motor' => ['required', Rule::in(["Electrico"])],
            'cambio' => ['required', Rule::in(["Automatico", "Manual"])],
            'equipamiento' => 'required|max:100',
            'puertas' => ['required', Rule::in(["4", "5"])],
            'asientos' => ['required', Rule::in(["2", "3", "4", "5", "6", "7"])],
            'autonomia' => 'required|gt:0|lt:5000|decimal:0,2',
            'color' => 'required|max:30',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'descripcion' => 'nullable',
            'emision' => 'required|date|after: -1 day|before: +1 years|size:10',
            'vencimiento' => 'required|date|after:emision|before: +3 years|size:10',
            'costoDiario' => 'required|decimal:0,2|gt:0|lt:10000',
        ]);

        // Crea un nuevo vehículo y guarda la imagen proporcionada.
        $vehiculo = Vehiculo::create($request->except("foto"));
        $foto = StorageController::storeImage($request->file("foto"), $vehiculo->id, "vehiculo");
        $vehiculo->update(["foto" => $foto]);

        return redirect()->route("vehiculo.index");
    }

    /**
     * Muestra el formulario para editar un vehículo.
     *
     * @param \App\Models\Vehiculo $vehiculo El vehículo a editar.
     * @return \Illuminate\View\View Vista del formulario de edición de vehículo.
     */
    public function edit(Vehiculo $vehiculo){
        return view('empleado.vehiculo-edit', ['vehiculo' => $vehiculo]);
    }

    /**
     * Actualiza el vehículo en la base de datos con los datos enviados.
     *
     * @param \Illuminate\Http\Request $request Solicitud HTTP entrante con los datos actualizados.
     * @param \App\Models\Vehiculo $vehiculo El vehículo a actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de vehículos.
     */
    public function update(Request $request, Vehiculo $vehiculo){
        // Validación de la solicitud entrante.
        $request->validate([
            'matricula' => ['required', 'regex:/^\d{4}[a-zA-Z]{3}$/', 'size:7', Rule::unique('vehiculo', 'matricula')->ignore($vehiculo)],
            'modelo' => 'required|max:100',
            'marca' => 'required|max:30',
            'motor' => ['required', Rule::in(["Eléctrico"])],
            'cambio' => ['required', Rule::in(["Automatico", "Manual"])],
            'equipamiento' => 'required|max:100',
            'puertas' => ['required', Rule::in(["4", "5"])],
            'asientos' => ['required', Rule::in(["2", "3", "4", "5", "6", "7"])],
            'autonomia' => 'required|gt:0|lt:5000|decimal:0,2',
            'color' => 'required|max:30',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'descripcion' => 'nullable',
            'costoDiario' => 'required|decimal:0,2|gt:0|lt:10000',
        ]);

        // Si se cambian las fechas de emisión o vencimiento, validar las nuevas fechas.
        if ($request->emision != $vehiculo->emision or $request->vencimiento != $vehiculo->vencimiento) {
            $request->validate([
                'emision' => 'date|after: -1 day|before: +1 years|size:10',
                'vencimiento' => 'date|after:emision|before: +3 years|size:10',
            ]);
        }

        // Actualiza los datos del vehículo.
        $vehiculo->update($request->except("foto"));

        // Si se proporciona una foto, actualízala.
        if ($request->hasFile("foto")) {
            $foto = StorageController::updateImage($request->file("foto"), $vehiculo->id, "vehiculo");
            $vehiculo->update(["foto" => $foto]);
        }

        return redirect()->route("vehiculo.index");
    }

    /**
     * Elimina el vehículo de la base de datos.
     *
     * @param \App\Models\Vehiculo $vehiculo El vehículo a eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de vehículos.
     */
    public function destroy(Vehiculo $vehiculo){
        // Elimina la foto del vehículo.
        StorageController::findAndDeleteImage($vehiculo->id, "vehiculo");
        
        // Elimina el vehículo de la base de datos.
        $vehiculo->delete();
        
        return redirect()->route("vehiculo.index");
    }

    /**
     * Busca los vehículos que cumplen con los filtros.
     *
     * @param \Illuminate\Http.Request $request Solicitud HTTP entrante con los parámetros de búsqueda.
     * @return \Illuminate\View.View Vista del catálogo con los resultados de la búsqueda.
     */
    public function search(Request $request){
        // Validación de la solicitud entrante.
        $request->validate([
            'priceMin' => 'nullable|integer|min:0|max:4950',
            'priceMax' => 'nullable|integer|min:50|max:5000',
            'asientos' => ['nullable', Rule::in(["2", "3", "4", "5", "6", "7"])],
        ]);

        // Validación de fechas si se especifican.
        if ($request->has("fechaRecogida") or $request->has("fechaEntrega")) {
            $request->validate([
                'fechaRecogida' => 'required|date|after:today|before: +1 years|size:10',
                'fechaEntrega' => 'required|date|after:fechaRecogida|before: +3 years|size:10',
                'horaRecogida' => Rule::in(["08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30"]),
                'horaEntrega' => Rule::in(["08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30"]),
                'lugarRecogida' => Rule::in(["Aeropuerto de El Prat de Llobregat", "Aeropuerto de Girona", "Aeropuerto de Reus"]),
                'lugarEntrega' => Rule::in(["Aeropuerto de El Prat de Llobregat", "Aeropuerto de Girona", "Aeropuerto de Reus"]),
            ]);
        }

        // Realiza la búsqueda de vehículos según los parámetros especificados.
        if ($request->filled("search") or $request->filled("priceMin") or $request->filled("priceMax") or $request->filled("asientos")) {
            $result =
                Vehiculo::whereBetween("costoDiario", [$request->priceMin, $request->priceMax])

                ->when($request->filled("search"), function ($q) use ($request) {
                    $q->where(function ($query) use ($request) {
                        $query->where('modelo', 'LIKE', "%$request->search%")
                            ->orWhere('marca', 'LIKE', "%$request->search%");
                    });
                })

                ->when($request->filled("asientos"), function ($q) use ($request) {
                    $q->where('asientos', $request->asientos);
                })

                ->when($request->filled("fechaRecogida"), function ($q) use ($request) {
                    $q->where(function ($query) use ($request) {
                        $query->whereDate('emision', '<=', $request->fechaRecogida)
                            ->whereDate('vencimiento', '>=', $request->fechaEntrega);
                    })
                        ->where(function ($query) use ($request) {
                            $query->whereHas('alquiler', function ($que) use ($request) {
                                $que->where('activo', true)->where(function ($q) use ($request) {
                                    $q->whereDate('fechaEntrega', '<=', $request->fechaRecogida)
                                        ->orWhereDate('fechaRecogida', '>=', $request->fechaEntrega);
                                });
                            })
                                ->orWhereDoesntHave('alquiler');
                        });
                })->paginate(10);
        } else {
            $result = [];
        }

        return view("public.catalogo", ["result" => $result]);
    }
}
