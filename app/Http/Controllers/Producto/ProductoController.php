<?php

namespace App\Http\Controllers\Producto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Producto;
use Illuminate\Support\Facades\DB;
use App\Categoria;

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
        set_time_limit(300);
        $fila = 0;  
        if (($gestor = fopen("data.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor)) !== FALSE) {
                //$numero = count($datos);
                //echo $fila."<br>\n";
                if($fila)
                {
                    $producto=new Producto();
                    for ($c=0; $c < 27; $c++) {
                        
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
                             // case 24:
                            //         $categoria1=Categoria::where('nombre',$datos[$c])->get();/*encuentra nivel 1*/
                            //         foreach ($categoria1->hijos as $c2) {
                            //            if($c2->nombre==$datos[$c+1])/*Encuentra nivel 2*/
                            //            {
                            //                 if(isset($c2->hijos))
                            //                 {
                            //                     foreach ($c2->hijos as $c3) {
                            //                         if($c3->nombre==$datos[$c+2])
                            //                         {
                            //                             $producto->categoria_id=$c3->id;
                            //                             break 2;

                            //                         }
                            //                     }
                            //                 }
                            //                 else
                            //                 {
                            //                         $producto->categoria_id=$c2->id;
                            //                         break;
                            //                 }

                            //            }
                            //         }
                            case 24:
                                    $categoria1=Categoria::where('nombre',$datos[$c])->get();
                                    foreach ($categoria1 as $c1) {
                                        foreach ($c1->hijos as $h) {
                                            if($datos[$c+1]==$h->nombre || $datos[$c+2]==$h->nombre)
                                            {
                                                if(isset($h->hijos))
                                                {
                                                    foreach ($h->hijos as $nieto) {
                                                        if($datos[$c+2]==$nieto->nombre)
                                                        {
                                                            $producto->categoria_id=$nieto->id;
                                                            break 3;
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    $producto->categoria_id=$h->id;
                                                    break 2;
                                                }   
                                            }
                                        }
                                    }
                                    //dd($categoria2);

                                    // if($categoria->count())
                                    // {
                                    //     $producto->categoria_id=$categoria->first()->id;
                                    // }
                                    // elseif ($categoria2->count()) {
                                    //     $producto->categoria_id=$categoria2->first()->id;
                                    // }
                                    // elseif ($categoria3->count()) {
                                    //     $producto->categoria_id=$categoria3->first()->id;
                                    // }
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

    public function CargarDatos()
    {

    }
}
