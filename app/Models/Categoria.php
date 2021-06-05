<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $timestamps = false;
    public $table = 'categorias';
    protected $primaryKey = 'categoriaID';
    use HasFactory;

    public function productos() {
        return $this->hasMany(Producto::class, 'categoriaID', 'productoID');
    }

    public function scopeActivas($query) {
        return $query->where('activa','=','1');
    }
}
