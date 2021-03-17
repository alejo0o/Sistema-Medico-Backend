<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
    use HasFactory;
    protected $table = 'consultorios';
    protected $fillable = ['nombre', 'descripcion', 'vision', 'mision', 'ruc', 'direccion', 'telefono', 'logo', 'correo', 'red_social1', 'red_social2'];
    protected $primaryKey = 'consultorio_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
