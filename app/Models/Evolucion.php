<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evolucion extends Model
{
    use HasFactory;
    protected $table = 'evoluciones';
    protected $fillable = [
        'historia_clinica_id',
        'fecha',
        'motivo_consulta',
        'fecha_ultima_menstruacion',
        'procedimiento',
        'diagnostico',
        'tratamiento',
        'proximo_control'
    ];
    protected $primaryKey = 'evolucion_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
