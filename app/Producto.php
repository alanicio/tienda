<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'modelo',
        'marca',
        'titulo',
        'costo',
        'peso',
        'imagen',
        'descripcion'
    ];
}
