<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Citas extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'id_veterinario',
        'id_cliente',
        'id_mascota',
        'nota',
        'estado',
        'inicio',
        'fin'
    ];

    public $timestamps = false;

    public function CLIENTE()
    {
        return $this->belongsTo(Clientes::class, 'id_cliente');
    }

    public function MASCOTA()
    {
        return $this->belongsTo(Mascotas::class, 'id_mascota');
    }
}