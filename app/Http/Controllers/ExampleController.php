<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Currency;
use View;
class ExampleController extends Controller
{
    public function example(){
		// $var = 'ABCDEFGH:/MNRPQR/';
		// echo "Original: $var<hr />\n";

		// /* Estos dos ejemplos reemplazan todo $var por 'bob'. */
		// echo substr_replace($var, 'bob', 0) . "<br />\n";
		// echo substr_replace($var, 'bob', 0, strlen($var)) . "<br />\n";

		// /* Inserta 'bob' justo al comienzo de $var. */
		// echo substr_replace($var, 'bob', 0, 0) . "<br />\n";

		//  //Estos dos siguientes reemplazan 'MNRPQR' en $var por 'bob'. 
		// echo substr_replace($var, 'bob', 10, -1) . "<br />\n";
		// echo substr_replace($var, 'bob', -7, -1) . "<br />\n";

		// /* Elimina 'MNRPQR' de $var. */
		// echo substr_replace($var, '', 10, -1) . "<br />\n";


		// echo substr_replace($var, 'bob', 10, 3) . "<br />\n";
		// $var='aaa';
		// echo 'strpos da '.strpos($var,'a').'<br>';

		$string='termica';
		$resul=[];
		$original=$string;
		$i=0;

		while(strpos($string, 'a')!==FALSE){
			$resul[]=substr_replace($original,'á',strpos($string,'a')-$i,1);
			$string=substr_replace($string,'á',strpos($string,'a'),1);
			//$resul[]=substr_replace($original,'á',strpos($string,'a'),1);
			echo $string.'<br>';
			$i++;
		}

		dd($resul);
      }
}
