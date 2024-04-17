<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
