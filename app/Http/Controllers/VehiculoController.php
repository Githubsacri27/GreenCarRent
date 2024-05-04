<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use Illuminate\Validation\Rule;

class VehiculoController extends Controller
{
    /**
     * Muestra la página con los detalles del vehiculo
     */
    public function mostrar($id)
    {
        $vehiculos = Vehiculo::findOrFail($id);
        return view("public/vehiculo-mostrar", ["vehiculo" => $vehiculos]);
    }
    /**
     * Muestra la lista de vehiculos en la BD limitando los resultados a 10 para optimizar rendimiento.
     */
    public function index()
    {
        $vehiculos = Vehiculo::paginate(10);
        return view("empleado.vehiculo-index", ["vehiculos" => $vehiculos]);
    }

    public function edit(Vehiculo $vehiculo){
        // Retorna una vista para editar un vehículo.
        return view('empleado.vehiculo-edit', ['vehiculo' => $vehiculo]);
    }


    /**
     * Muestra el formulario para crear un nuevo vehiculo
     */
    public function create()
    {
        return view("empleado.vehiculo-create");
    }


    /**
     * Guarda un nuevo vehiculo en la base de datos
     */
    public function store(Request $request)
    {
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

        $vehiculo = Vehiculo::create($request->except("foto"));
        $foto = StorageController::storeImage($request->file("foto"), $vehiculo->id, "vehiculo");
        $vehiculo->update(["foto" => $foto]);

        return redirect()->route("vehiculo.index");
    }

    /**
     * Actualiza el vehiculo en la base de datos con los datos enviados
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $request->validate([
            'matricula' => ['required', 'regex:/^\d{4}[a-zA-Z]{3}$/', 'size:7', Rule::unique("vehiculo", "matricula")->ignore($vehiculo)],
            'modelo' => 'required|max:100',
            'marca' => 'required|max:30',
            'motor' => ['required', Rule::in(["Electrico"])],
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

        if ($request->emision != $vehiculo->emision or $request->vencimiento != $vehiculo->vencimiento) {
            $request->validate([
                'emision' => 'date|after: -1 day|before: +1 years|size:10',
                'vencimiento' => 'date|after:emision|before: +3 years|size:10',
            ]);
        }

        $vehiculo->update($request->except("foto"));

        if ($request->hasFile("foto")) {
            $foto = StorageController::updateImage($request->file("foto"), $vehiculo->id, "vehiculo");
            $vehiculo->update(["foto" => $foto]);
        }

        return redirect()->route("vehiculo.index");
    }


    /**
     * Elimina el vehiculo de la base de datos
     */
    public function destroy(Vehiculo $vehiculo)
    {
        StorageController::findAndDeleteImage($vehiculo->id, "vehiculo");
        $vehiculo->delete();
        return redirect()->route("vehiculo.index");
    }


    /**
     * Busca los vehiculos que cumplen con los parámetros especificados
     */
    public function search(Request $request)
    {

        $request->validate([
            'priceMin' => 'nullable|integer|min:0|max:4950',
            'priceMax' => 'nullable|integer|min:50|max:5000',
            'asientos' => ['nullable', Rule::in(["2", "3", "4", "5", "6", "7"])],
        ]);

        if ($request->has("fechaRecogida") or $request->has("fechaEntrega")) {
            $request->validate([
                'fechaRecogida' => 'required|date|after:today|before: +1 years|size:10',
                'fechaEntrega' => 'required|date|after:fechaRecogida|before: +3 years|size:10',
                "horaRecogida" => Rule::in(["08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30"]),
                "horaEntrega" => Rule::in(["08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30"]),
                'lugarRecogida' => Rule::in([
                    "Aeropuerto de El Prat de Llobregat",
                    "Aeropuerto de Girona",
                    "Aeropuerto de Reus"
                ]),
                'lugarEntrega' => Rule::in([
                    "Aeropuerto de El Prat de Llobregat",
                    "Aeropuerto de Girona",
                    "Aeropuerto de Reus",
                ]),
            ]);
        }


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
