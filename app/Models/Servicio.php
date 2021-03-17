<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $table = 'servicios';
    protected $fillable = [
        'servicio_id',
        'consultorio_id',
        'titulo',
        'imagen',
    ];
    protected $primaryKey = 'servicio_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
