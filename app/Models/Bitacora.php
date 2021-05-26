<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;

    public $timestamps  = false;
    public $table = 'bitacora';
    protected $fillable = ['quien', 'accion', 'que'];
}
