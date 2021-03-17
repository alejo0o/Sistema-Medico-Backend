<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $table = 'pacientes';
    protected $fillable = [
        'paciente_id',
        'tipo_de_sangre_id',
        'etnia_id',
        'nivel_de_instruccion_id',
        'estado_civil_id',
        'nombres',
        'apellidos',
        'cedula',
        'fechanacimiento',
        'lugarnacimiento',
        'direccion',
        'telefono',
        'contacto_emergencia_nombre',
        'contacto_emergencia_telefono'
    ];
    protected $primaryKey = 'paciente_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
