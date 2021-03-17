<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capitulo extends Model
{
    use HasFactory;

    protected $table = 'capitulos';
    protected $fillable = ['codigo', 'descripcion'];
    protected $primaryKey = 'capitulo_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
