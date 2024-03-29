<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use HasFactory;
    protected $table = 'tratamientos';
    protected $fillable = ['nombre', 'precio'];
    protected $primaryKey = 'tratamiento_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
