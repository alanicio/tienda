<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Mail;
use App\Mail\ReciboDeCompra;
use App\Venta;
use Session;
use PDF;
use App\Categoria;

class ExampleController extends Controller
{
    public function example(){
    	 dd(Categoria::get()->count());
    	
    }
}
