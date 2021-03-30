<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;
    protected $table = 'generos';
    protected $fillable = ['genero'];
    protected $primaryKey = 'genero_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
