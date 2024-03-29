<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory;
    protected $table = 'subcategorias';
    protected $fillable = [
        'categoria_id',
        'codigo',
        'descripcion'
    ];
    protected $primaryKey = 'subcategoria_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
