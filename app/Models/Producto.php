<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $timestamps = true;
    public $table = 'productos';
    protected $primaryKey = 'productoID';
    use HasFactory;

    public function scopeActivos($query) {
        return $query->where('activo', '=', '1');
    }

    public function scopeBuscar($query, $find) {
        return $query->where('activo', '=', '1')->where('nombre', 'LIKE', '%'.$find.'%')
        ->orWhere('activo', '=', '1')->where('descripcion', 'LIKE', '%'.$find.'%');
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class, 'categoriaID', 'categoriaID');
    }
}
