<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Historial extends Model
{
    use HasFactory;

    protected $table = 'historial_clinico';
    protected $fillable = [
        'id_veterinario',
        'id_mascota',
        'id_cita',
        'nota',
        'fecha'
        
    ];

    public $timestamps = false;

    public function VETERINARIO()
    {
        return $this->belongsTo(User::class, 'id_veterinario');
    }
}
