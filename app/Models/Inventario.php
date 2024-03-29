<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    protected $table = 'inventario';
    protected $fillable = [
        'nombre',
        'costo_unitario',
        'cantidad',
    ];
    protected $primaryKey = 'inventario_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
