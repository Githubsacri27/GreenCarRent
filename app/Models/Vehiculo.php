<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculo';

    protected $fillable = [
        'matricula',
        'modelo',
        'marca',
        'motor',
        'cambio',
        'equipamiento',
        'puertas',
        'asientos',
        'autonomia',
        'color',
        'foto',
        'descripcion',
        'emision',
        'vencimiento',
        'costoDiario',
    ];
}
