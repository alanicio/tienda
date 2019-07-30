<?php

namespace App\Http\Controllers\Venta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AtencionAlCliente;
use Mail;

class AtencionClienteController extends Controller
{
    public function contacto(Request $request)
    {
    	Mail::to('gabriela@sistemasnonex.com')->send(new AtencionAlCliente($request->all()));
    	dd($request->all());
    }
}
