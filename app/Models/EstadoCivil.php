<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    use HasFactory;
    protected $table = 'estados_civiles';
    protected $fillable = ['estado_civil'];
    protected $primaryKey = 'estado_civil_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
