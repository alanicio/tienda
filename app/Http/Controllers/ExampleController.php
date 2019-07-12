<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Mail;
use App\Mail\ReciboDeCompra;
use App\Venta;

class ExampleController extends Controller
{
    public function example(){
    	$venta=new Venta;
    	Mail::to(['alanicio98@outlook.com','alamau98@gmail.com'])->send(new ReciboDeCompra($venta));
    }
}
