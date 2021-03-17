<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use HasFactory;
    protected $table = 'tratamientos';
    protected $fillable = ['tratamiento_id', 'nombre', 'precio'];
    protected $primaryKey = 'tipo_de_sangre_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
