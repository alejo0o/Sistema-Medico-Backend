<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriaClinica extends Model
{
    use HasFactory;
    protected $table = 'historias_clinicas';
    protected $fillable = [
        'paciente_id',
        'alergias',
        'antecedentes_patologicos',
        'antecedentes_quirurgicos',
        'antecedentes_familiares',
        'medicamentos_subministrados',
        'gestas',
        'partos',
        'cesareas',
        'abortos',
        'metodo_anticonceptivo',
        'habitos'
    ];
    protected $primaryKey = 'historia_clinica_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
