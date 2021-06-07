<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesVenta extends Model
{
    public $timestamps = false;
    public $table = 'detalles_ventas';
    protected $primaryKey = 'id';
    use HasFactory;
}
