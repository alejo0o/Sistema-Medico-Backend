<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    protected $table = 'citas';
    protected $fillable = ['paciente_id', 'medico_id', 'fecha', 'hora', 'motivo_cita'];
    protected $primaryKey = 'cita_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
