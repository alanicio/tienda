<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
     protected $fillable = [
        'subtotal',
        'total',
        'user_id'
    ];

    protected $hidden = [
        'remember_token','created_at',
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function productos(){
        return $this->belongsToMany('App\Producto','productos_ventas')->withPivot('producto_id','cantidad');
    }
}
