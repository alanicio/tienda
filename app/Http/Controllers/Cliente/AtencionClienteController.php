<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AtencionClienteController extends Controller
{
    public function contacto(Request $request)
    {
    	dd($request->all());
    }
}
