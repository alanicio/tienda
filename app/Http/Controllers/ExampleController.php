<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Currency;
use View;
class ExampleController extends Controller
{
    public function example(){
     	//echo $valueNOK = Currency::conv($from = 'USD', $to = 'MXN', $value = 1, $decimals = 2);
     	$html = file_get_contents('https://www.syscom.mx/');
     	//echo $html;
     	$posicion=strpos($html,'TC:');
     	dd(floatval(substr($html, $posicion+5,5)));
      }
}
