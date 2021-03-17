<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriaClinica extends Model
{
    use HasFactory;
    protected $table = 'historias_clinicas';
    protected $fillable = [
        'historia_clinica_id',
        'paciente_id',
        'antecedentes_patologicos',
        'antecedentes_quirurgicos',
        'alergias',
        'gestas',
        'partos',
        'cesareas',
        'abortos',
        'metodo_anticonceptivo'
    ];
    protected $primaryKey = 'historia_clinica_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
