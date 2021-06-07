<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public $timestamps = false;
    public $table = 'ventas';
    protected $primaryKey = 'ventaID';
    use HasFactory;

}
