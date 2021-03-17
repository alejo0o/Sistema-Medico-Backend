<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDeSangre extends Model
{
    use HasFactory;
    protected $table = 'tipos_de_sangre';
    protected $fillable = ['tipo_de_sangre_id', 'tipo_sangre'];
    protected $primaryKey = 'tipo_de_sangre_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
