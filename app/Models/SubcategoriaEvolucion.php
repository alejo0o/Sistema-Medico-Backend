<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcategoriaEvolucion extends Model
{
    use HasFactory;
    protected $table = 'subcategorias_evoluciones';
    protected $fillable = [
        'evolucion_id',
        'subcategoria_id',
    ];
    protected $primaryKey = 'evolucion_id';

    protected $keyType = 'int';
    public $timestamps = false;
}
