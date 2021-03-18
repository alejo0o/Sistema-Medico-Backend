<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $table = 'servicios';
    protected $fillable = [
        'consultorio_id',
        'titulo',
        'imagen',
        'descripcion'
    ];
    protected $primaryKey = 'servicio_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
