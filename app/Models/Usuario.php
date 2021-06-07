<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable {
    public $timestamps = true;
    public $table = 'usuarios';
    protected $primaryKey = 'usuarioID';
    protected $fillable = ['nombre','a_paterno','a_materno','correo','imagen','rol','activo','password'];
}
