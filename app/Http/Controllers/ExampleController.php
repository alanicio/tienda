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
    	dd(Session::all());
    	
    }
}
