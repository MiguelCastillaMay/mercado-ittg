<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'pagos';
    protected $primaryKey = 'pagoID';
}
