<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etnia extends Model
{
    use HasFactory;
    protected $table = 'etnias';
    protected $fillable = ['etnia'];
    protected $primaryKey = 'etnia_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
