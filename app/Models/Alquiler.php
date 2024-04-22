<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alquiler extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'alquiler';


    protected $fillable = [
        'importe',
        'fechaRecogida',
        'lugarRecogida',
        'horaRecogida',
        'fechaEntrega',
        'lugarEntrega',
        'horaEntrega',
        'activo',
        'clienteID',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, "clienteID", "id");
    }


    public function vehiculo(): BelongsTo
    {
        return $this->belongsTo(Vehiculo::class, "vehiculoID", "id");
    }
}
