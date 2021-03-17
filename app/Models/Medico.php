<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;
    protected $table = 'medicos';
    protected $fillable = [
        'medico_id',
        'consultorio_id',
        'cedula',
        'nombres',
        'apellidos'
    ];
    protected $primaryKey = 'medico_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
