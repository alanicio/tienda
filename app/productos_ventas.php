<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productos_ventas extends Model
{
    protected $fillable = [
        'venta_id',
        'producto_id',
        'cantidad',
        'precio_en_compra_USD',
		'precio_en_compra_MXN'
    ];
}
