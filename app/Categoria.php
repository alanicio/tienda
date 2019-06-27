<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'id',
        'nombre',
        'categoria_padre',
        'nivel',
    ];

    public function padre() {
        return $this->belongsTo('App\Categoria','categoria_padre');
    }
    public function hijos() {
        return $this->hasMany('App\Categoria','categoria_padre');
    }
    public function productos(){
        return $this->hasMany('App\Producto');
    }
}
