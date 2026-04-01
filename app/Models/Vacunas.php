<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacunas extends Model
{
    use HasFactory;

    protected $table = 'vacunas';

    protected $fillable = [

        'id_mascota',
        'vacuna',
        'fecha',
        'prox_fecha',
        'id_veterinario'

    ];

    public $timestamps = false;

     public function VETERINARIO()
    {
        return $this->belongsTo(User::class, 'id_veterinario');
    }
}
