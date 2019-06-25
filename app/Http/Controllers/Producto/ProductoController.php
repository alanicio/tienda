<?php

namespace App\Http\Controllers\Producto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Producto;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Tienda.tienda',['productos'=>Producto::paginate(30)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto=Producto::find($id);
        //dd($producto);
        return view('Tienda.show',['producto'=>$producto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function CargarProductos()
    {
        // $fila = 1;
        // if (($gestor = fopen("data.csv", "r")) !== FALSE) {
        //     while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
        //         //$numero = count($datos);
        //         $fila++;
        //         for ($c=22; $c < 23; $c++) {
        //             if(isset($datos[$c]))
        //                 echo $c.' '.$datos[$c] . "<br />\n";
        //             else
        //                 echo "VACIO". "<br />\n";
        //         }

        //         if($fila==20)
        //             break;
                
        //     }
        //     fclose($gestor);
        // }





        // file_put_contents("data.csv", fopen("http://syscom.mx/principal/reporte_art_hora?cadena1=104511683&cadena2=ecab1f7d0a20621a021555208cf8b441&all=1&cadena3=1&img=1&ctg=8&sel=0&lnk=1", 'r'));
        $fila = 0;  
        if (($gestor = fopen("data.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor)) !== FALSE) {
                //$numero = count($datos);
                //echo $fila."<br>\n";
                if($fila)
                {
                    $producto=new Producto();
                    for ($c=0; $c < 24; $c++) {
                        
                        switch ($c) {
                            case 0:
                                    $data=DB::connection()->getPdo()->quote(utf8_encode($datos[$c]));
                                    $producto->modelo=$data;
                                break;
                            case 1:
                                    $data=DB::connection()->getPdo()->quote(utf8_encode($datos[$c]));
                                    $producto->marca=$data;
                                break;
                            case 2:
                                    $data=DB::connection()->getPdo()->quote(utf8_encode($datos[$c]));
                                    $producto->titulo=$data;
                                break;
                            case 5:
                                    $producto->costo=$datos[$c];
                            case 21:
                                    $producto->peso=$datos[$c];
                                break;
                            case 22:
                                    $data=DB::connection()->getPdo()->quote(utf8_encode($datos[$c]));
                                    $producto->descripcion=$data;
                                break;        
                            case 23:
                                    $producto->imagen=$datos[$c];
                                break;   
                           
                            // default:
                            //     # code...
                            //     break;
                        }
                    }
                    $producto->save();
                }
                $fila++;
            }
            fclose($gestor);
        }
        return $this->index();
    }
}
