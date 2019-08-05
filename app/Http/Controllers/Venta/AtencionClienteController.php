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
    	Mail::to('ventas@sistemasnonex.com ')->send(new AtencionAlCliente($request->all()));
    	return redirect('/');
    }
}
