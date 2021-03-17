<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NivelDeInstruccion extends Model
{
    use HasFactory;
    protected $table = 'niveles_de_instruccion';
    protected $fillable = ['nivel_de_instruccion_id', 'nivel_de_instruccion'];
    protected $primaryKey = 'nivel_de_instruccion_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
