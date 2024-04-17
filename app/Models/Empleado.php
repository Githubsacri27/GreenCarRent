<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleado';

    public $timestamps = false;

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'foto',
    ];

    public function usuario(): MorphOne
    {
        return $this->morphOne(Usuario::class, 'utenteable');
    }
}
