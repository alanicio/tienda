<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Mail;
use App\Mail\ReciboDeCompra;
use App\Venta;
use Session;
use PDF;

class ExampleController extends Controller
{
    public function example(){
    	$pdf = PDF::loadView('PDF.Recibo', ['venta'=>Venta::find(5)]);
    	return view('PDF.Recibo',['venta'=>Venta::find(5)]);
    	
    }
}
