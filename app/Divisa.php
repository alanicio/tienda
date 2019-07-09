<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divisa extends Model
{
    protected $fillable = [
        'valor_del_dolar',
    ];

     protected $hidden = [
        'remember_token','created_at',
    ];
}
