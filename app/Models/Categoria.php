<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';
    protected $fillable = ['capitulo_id', 'codigo', 'descripcion'];
    protected $primaryKey = 'categoria_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
