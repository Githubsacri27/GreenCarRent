<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellidos',
        'domicilio',
        'ocupacion',
        'fechaNacimiento',
        'foto',
    ];

    public function usuario(): MorphOne
    {
        return $this->morphOne(Usuario::class, 'utenteable');
    }

}
