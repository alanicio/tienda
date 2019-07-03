<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Currency;
class ExampleController extends Controller
{
    public function example(){
     	echo $valueNOK = Currency::conv($from = 'USD', $to = 'MXN', $value = 1, $decimals = 2);
      }
}
