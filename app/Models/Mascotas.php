<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascotas extends Model
{
    use HasFactory;

    protected $table = 'mascotas';
    protected $fillable = [
        'nombre',
        'especie',
        'raza',
        'edad',
        'peso',
        'id_cliente',
        'detalles',
        'sexo',
        'foto'
    ];

    public $timestamps = false;

}
