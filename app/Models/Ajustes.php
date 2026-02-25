<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajustes extends Model
{
    use HasFactory;

    protected $table = 'ajustes';

    protected $fillable = [

        'telefono',
        'direccion',
        'moneda',
        'zona_horaria',

    ];

    public $timestamps = false;
}
