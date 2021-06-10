<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    public $timestamps = true;
    public $table = 'respuestas';
    protected $primaryKey = 'respuestaID';
    use HasFactory;

}
