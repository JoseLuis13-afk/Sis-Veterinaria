<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Internaciones extends Model
{
    use HasFactory;

    protected $table = 'internaciones';

    protected $fillable = [

        'id_mascota',
        'id_cita',
        'fecha_inicio',
        'fecha_alta',
        'motivo',
        'expediente'

    ];

    public $timestamps = false;

    public function MASCOTA()
    {
        return $this->belongsTo(Mascotas::class, 'id_mascota');
    }
}
