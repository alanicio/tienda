<?php

namespace App\Http\Controllers\Producto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Producto;
use Illuminate\Support\Facades\DB;
use App\Categoria;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Tienda.tienda',['productos'=>Producto::orderBy('inventario','desc')->paginate(15)]);
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

    public function Buscar(Request $request)
    {
        $palabra=$request->search;
        $productos=Producto::where('modelo','LIKE','%'.$palabra.'%')->orWhere('marca','LIKE','%'.$palabra.'%')->orWhere('titulo','LIKE','%'.$palabra.'%')->orWhere('descripcion','LIKE','%'.$palabra.'%')->paginate(15);
        return view('Tienda.tienda',['productos'=>$productos]);
    }

    //algoritmo de busqueda en proceso de mejora
    // public function Buscar(Request $request)
    // {
    //     $palabras=explode(" ",$request->search);
    //     $palabra=$request->search;
    //     $productos=collect(new Producto);
    //     // $productos=Producto::where('modelo','LIKE','%'.$palabra.'%')->orWhere('marca','LIKE','%'.$palabra.'%')->orWhere('titulo','LIKE','%'.$palabra.'%')->orWhere('descripcion','LIKE','%'.$palabra.'%')->get();
    //     foreach ($palabras as $p) {
    //         $por_palabra=Producto::where('modelo','LIKE','%'.$p.'%')->orWhere('marca','LIKE','%'.$p.'%')->orWhere('titulo','LIKE','%'.$p.'%')->orWhere('descripcion','LIKE','%'.$p.'%')->get();
    //         foreach ($por_palabra as $pp) {
    //             $productos->push($pp);
    //         }
    //     }
    //     $currentPage = LengthAwarePaginator::resolveCurrentPage();
    //     $perPage = 15;
    //     $currentPageItems = $productos->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
    //     $paginatedItems= new LengthAwarePaginator($currentPageItems , count($productos), $perPage);
    //     $paginatedItems->setPath($request->url());
    //     //dd($pagination);
    //     return view('Tienda.tienda',['productos'=>$paginatedItems]);
    // }

    public function CargarProductos()
    {
        // $html = file_get_contents('https://www.syscom.mx/');
        // $posicion=strpos($html,'TC:');
        // $MXN=floatval(substr($html, $posicion+5,5));
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
                                    $producto->modelo=substr($data,1,strlen($data)-2);
                                break;
                            case 1:
                                    $data=DB::connection()->getPdo()->quote(utf8_encode($datos[$c]));
                                    $producto->marca=substr($data,1,strlen($data)-2);
                                break;
                            case 2:
                                    $data=DB::connection()->getPdo()->quote(utf8_encode($datos[$c]));
                                    $producto->titulo=substr($data,1,strlen($data)-2);
                                break;
                            case 5:
                                    $producto->costoUSD=$datos[$c];
                                    $producto->costoMXN=($datos[$c]*$datos[11]);
                                    break;
                            case 6:
                                    $producto->inventario=$datos[$c];
                                    // for($z=6;$z<=19;$z++)
                                    // {
                                    //     $producto->inventario+=intval($datos[$z]);
                                    // }
                            case 8:
                                    $producto->peso=$datos[$c];
                                break;
                            case 9:
                                    $data=DB::connection()->getPdo()->quote(utf8_encode($datos[$c]));
                                    $producto->descripcion=$data;
                                break;        
                            case 10:
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
                            case 12:
                                    $categoria1=Categoria::where('nombre',$datos[$c])->get();
                                    foreach ($categoria1 as $c1) {
                                        foreach ($c1->hijos as $h) {
                                            if($datos[$c+1]==$h->nombre || $datos[$c+2]==$h->nombre)
                                            {
                                                if(isset($h->hijos) && $datos[$c+2]!='Todos' && $datos[$c+2]!='Todas' && $datos[$c+2]!='Ver Todas' && $datos[$c+2]!='Todo' && $datos[$c+2]!='---')
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
