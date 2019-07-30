<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccione extends Model
{
    protected $fillable = [
        'id',
        'calle',
        'num_ext',
        'num_int',
        'colonia',
        'codigo_postal',
        'municipio',
        'estado',
        'venta_id',
    ];

    public function venta(){
    	return $this->hasOne('App\Venta','venta_id');
    }
}
