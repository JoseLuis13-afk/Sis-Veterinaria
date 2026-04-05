<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receta extends Model
{
    use HasFactory;

    protected $fillable = [

        'id_cita',
        'receta'
        

    ];

    public $timestamps = false;
}
