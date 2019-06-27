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
        'descripcion',
        'categoria_id'
    ];

    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}
