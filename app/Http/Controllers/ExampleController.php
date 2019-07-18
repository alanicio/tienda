<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Mail;
use App\Mail\ReciboDeCompra;
use App\Venta;
use Session;

class ExampleController extends Controller
{
    public function example(){
    	$headers = get_headers('http://ftp3.syscom.mx/usuarios/fotos/kfranco/JR52/JR52det.jpg', 1);
    	dd($headers);
		if (strpos($headers['Content-Type'], 'image/') !== false) {
		    dd("Work");
		} else {
		    dd("Not Image");
		}   
    }
}
