<?php

namespace App\Http\Controllers\Producto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Producto;
use Illuminate\Support\Facades\DB;
use App\Categoria;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index=true;
        return view('Tienda.tienda',['productos'=>Producto::orderBy('inventario','desc')->paginate(9)]);
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

    public function permalink($categoria,$id,$titulo,$marca,$modelo)
    {
        //dd($id);
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

    // public function Buscar(Request $request)
    // {
    //     $palabra=$request->search;
    //     $productos=Producto::where('modelo','LIKE','%'.$palabra.'%')->orWhere('marca','LIKE','%'.$palabra.'%')->orWhere('titulo','LIKE','%'.$palabra.'%')->orWhere('descripcion','LIKE','%'.$palabra.'%')->paginate(15);
    //     return view('Tienda.tienda',['productos'=>$productos]);
    // }

    /*VERSION 2, BUSCA QUE TODAS LAS PALABRAS ESTEN EN EL OBJETO, SIN IMPORTAR EL ORDEN*/
    // public function Buscar(Request $request)
    // {
    //     $palabras=preg_split('/\s+/', $request->search, -1, PREG_SPLIT_NO_EMPTY);
    //     $productos=DB::table('productos');
    //     //$oracion=$request->search;
    //     foreach ($palabras as $key => $palabra) {
    //         $productos->where(function($query) use($palabra){
  
    //             $query->orWhere('marca','LIKE','%'.$palabra.'%')->orWhere('titulo','LIKE','%'.$palabra.'%')->orWhere('descripcion','LIKE','%'.$palabra.'%')->orWhere('marca','LIKE','%'.utf8_encode($palabra).'%')->orWhere('titulo','LIKE','%'.utf8_encode($palabra).'%')->orWhere('descripcion','LIKE','%'.utf8_encode($palabra).'%');
    //         });
    //     }
    //     return view('Tienda.tienda',['productos'=>$productos->paginate(15)]);
    // }

    /*BLOQUE DE CODIGO DE ARRIBA ES DE LA VERSION 2*/




    /*Version 3, BUSCA CON ACENTO Y SIN ACENTO, PERO ES ALGO LENTO*/
    // public function Buscar(Request $request)
    // {
    //     $oracion=strtolower($request->search);
    //     $palabras=preg_split('/\s+/', strtolower($request->search), -1, PREG_SPLIT_NO_EMPTY);
    //     //dd($palabras);
    //     $productos=DB::table('productos');      
    //     foreach ($palabras as $key => $palabra) {
    //         $productos->where(function($query) use($palabra){
    //             $query->orWhere('marca','LIKE','%'.$palabra.'%')->orWhere('titulo','LIKE','%'.$palabra.'%')->orWhere('descripcion','LIKE','%'.$palabra.'%')->orWhere('marca','LIKE','%'.utf8_encode($palabra).'%')->orWhere('titulo','LIKE','%'.utf8_encode($palabra).'%')->orWhere('descripcion','LIKE','%'.utf8_encode($palabra).'%');
    //             $acentos=$this->PosiblesAcentos($palabra);
    //             foreach ($acentos as $ac) {
    //                 $query->orWhere('marca','LIKE','%'.$ac.'%')->orWhere('titulo','LIKE','%'.$ac.'%')->orWhere('descripcion','LIKE','%'.$ac.'%')->orWhere('marca','LIKE','%'.utf8_encode($ac).'%')->orWhere('titulo','LIKE','%'.utf8_encode($ac).'%')->orWhere('descripcion','LIKE','%'.utf8_encode($ac).'%');
    //             }
    //         });
    //     }
    //     $productos->orWhere('modelo','LIKE','%'.$oracion.'%')->orWhere('marca','LIKE','%'.$oracion.'%')->orWhere('titulo','LIKE','%'.$oracion.'%')->orWhere('descripcion','LIKE','%'.$oracion.'%');
    //     return view('Tienda.tienda',['productos'=>$productos->paginate(9)]);
    // }

    // public function PosiblesAcentos($string)
    // {
    //     $resul=[];
    //     $original=$string;

    //     $i=0;
    //     while(strpos($string, 'a')!==FALSE){
    //         $resul[]=substr_replace($original,'á',strpos($string,'a')-$i,1);
    //         $string=substr_replace($string,'á',strpos($string,'a'),1);
    //         $i++;
    //     }

    //     $i=0;
    //     while(strpos($string, 'e')!==FALSE){
    //         $resul[]=substr_replace($original,'é',strpos($string,'e')-$i,1);
    //         $string=substr_replace($string,'é',strpos($string,'e'),1);
    //         $i++;
    //     }

    //     $i=0;
    //     while(strpos($string, 'i')!==FALSE){
    //         $resul[]=substr_replace($original,'í',strpos($string,'i')-$i,1);
    //         $string=substr_replace($string,'í',strpos($string,'i'),1);
    //         $i++;
    //     }

    //     $i=0;
    //     while(strpos($string, 'o')!==FALSE){
    //         $resul[]=substr_replace($original,'ó',strpos($string,'o')-$i,1);
    //         $string=substr_replace($string,'ó',strpos($string,'o'),1);
    //         $i++;
    //     }

    //     $i=0;
    //     while(strpos($string, 'u')!==FALSE){
    //         $resul[]=substr_replace($original,'ú',strpos($string,'u')-$i,1);
    //         $string=substr_replace($string,'ú',strpos($string,'u'),1);
    //         $i++;
    //     }

    //     return $resul;
    // }
    /*BLOQUE DE CODIGO DE ARRIBA ES DE LA VERSION 3*/

    // /*Version 4, Mejorada un poco la velocidad, alrededor de 3 s*/
    // public function Buscar(Request $request)
    // {
    //     $start = microtime(true);
    //     $oracion=strtolower($request->search);
    //     $palabras=preg_split('/\s+/', strtolower($request->search), -1, PREG_SPLIT_NO_EMPTY);
    //     //dd($palabras);
    //     $productos=DB::table('productos');
    //     //dd($palabras);
    //     foreach ($palabras as $key => $palabra) {
    //         $productos->where(function($query) use($palabra){
    //             $query->orWhere('marca','LIKE','%'.utf8_encode($palabra).'%')->orWhere('titulo','LIKE','%'.utf8_encode($palabra).'%')->orWhere('modelo','LIKE','%'.utf8_encode($palabra).'%')->orWhere('descripcion','LIKE','%'.utf8_encode($palabra).'%');
    //             $acentos=$this->PosiblesAcentos($palabra);
    //             foreach ($acentos as $ac) {
    //                 $query->orWhere('marca','LIKE','%'.utf8_encode($ac).'%')->orWhere('titulo','LIKE','%'.utf8_encode($ac).'%')->orWhere('descripcion','LIKE','%'.utf8_encode($ac).'%');
    //             }
    //         });
    //     }
    //     //$productos->orderBy('titulo',utf8_encode($request->search));
    //     return view('Tienda.tienda',['productos'=>$productos->paginate(9),'start'=>$start]);
    // }

    // public function PosiblesAcentos($string)
    // {
    //     $resul=[];
    //     $original=$string;

    //     $i=0;
    //     while(strpos($string, 'a')!==FALSE){
    //         $resul[]=substr_replace($original,'á',strpos($string,'a')-$i,1);
    //         $string=substr_replace($string,'á',strpos($string,'a'),1);
    //         $i++;
    //     }

    //     $i=0;
    //     while(strpos($string, 'e')!==FALSE){
    //         $resul[]=substr_replace($original,'é',strpos($string,'e')-$i,1);
    //         $string=substr_replace($string,'é',strpos($string,'e'),1);
    //         $i++;
    //     }

    //     $i=0;
    //     while(strpos($string, 'i')!==FALSE){
    //         $resul[]=substr_replace($original,'í',strpos($string,'i')-$i,1);
    //         $string=substr_replace($string,'í',strpos($string,'i'),1);
    //         $i++;
    //     }

    //     $i=0;
    //     while(strpos($string, 'o')!==FALSE){
    //         $resul[]=substr_replace($original,'ó',strpos($string,'o')-$i,1);
    //         $string=substr_replace($string,'ó',strpos($string,'o'),1);
    //         $i++;
    //     }

    //     $i=0;
    //     while(strpos($string, 'u')!==FALSE){
    //         $resul[]=substr_replace($original,'ú',strpos($string,'u')-$i,1);
    //         $string=substr_replace($string,'ú',strpos($string,'u'),1);
    //         $i++;
    //     }

    //     return $resul;
    // }
    /*BLOQUE DE CODIGO DE ARRIBA ES DE LA VERSION 4*/

    //   /*Version 5, velocidad exquisita, busqueda mas exacta entre mas palabras*/
    // public function Buscar(Request $request)
    // {
    //     $start = microtime(true);
    //     $oracion=strtolower($request->search);
    //     $palabras=preg_split('/\s+/', strtolower($request->search), -1, PREG_SPLIT_NO_EMPTY);
    //     //dd($palabras);
    //     $productos=DB::table('productos');
    //     //dd($palabras);
    //     foreach ($palabras as $key => $palabra) {
    //         $productos->where(function($query) use($palabra){
    //             $query->orWhere('marca','LIKE','%'.utf8_encode($palabra).'%')->orWhere('titulo','LIKE','%'.utf8_encode($palabra).'%')->orWhere('modelo','LIKE','%'.utf8_encode($palabra).'%');
    //             $acentos=$this->PosiblesAcentos($palabra);
    //             foreach ($acentos as $ac) {
    //                 $query->orWhere('marca','LIKE','%'.utf8_encode($ac).'%')->orWhere('titulo','LIKE','%'.utf8_encode($ac).'%');
    //             }
    //         });
    //     }
    //     //$productos->orderBy('titulo',utf8_encode($request->search));
    //     return view('Tienda.tienda',['productos'=>$productos->paginate(9)]);
    // }

    // public function PosiblesAcentos($string)
    // {
    //     $resul=[];
    //     $original=$string;

    //     $i=0;
    //     while(strpos($string, 'a')!==FALSE){
    //         $resul[]=substr_replace($original,'á',strpos($string,'a')-$i,1);
    //         $string=substr_replace($string,'á',strpos($string,'a'),1);
    //         $i++;
    //     }

    //     $i=0;
    //     while(strpos($string, 'e')!==FALSE){
    //         $resul[]=substr_replace($original,'é',strpos($string,'e')-$i,1);
    //         $string=substr_replace($string,'é',strpos($string,'e'),1);
    //         $i++;
    //     }

    //     $i=0;
    //     while(strpos($string, 'i')!==FALSE){
    //         $resul[]=substr_replace($original,'í',strpos($string,'i')-$i,1);
    //         $string=substr_replace($string,'í',strpos($string,'i'),1);
    //         $i++;
    //     }

    //     $i=0;
    //     while(strpos($string, 'o')!==FALSE){
    //         $resul[]=substr_replace($original,'ó',strpos($string,'o')-$i,1);
    //         $string=substr_replace($string,'ó',strpos($string,'o'),1);
    //         $i++;
    //     }

    //     $i=0;
    //     while(strpos($string, 'u')!==FALSE){
    //         $resul[]=substr_replace($original,'ú',strpos($string,'u')-$i,1);
    //         $string=substr_replace($string,'ú',strpos($string,'u'),1);
    //         $i++;
    //     }

    //     return $resul;
    // }
    // /*BLOQUE DE CODIGO DE ARRIBA ES DE LA VERSION 5*/

     /*Version 6, limpia acentos de las vocales unicamente*/
    public function Buscar(Request $request)
    {
        $start = microtime(true);
        //$oracion=strtolower($request->search);
        $palabras=preg_split('/\s+/', strtolower($this->LimpiarAcentos($request->search)), -1, PREG_SPLIT_NO_EMPTY);
        $productos=DB::table('productos');
        //dd($palabras);
        foreach ($palabras as $key => $palabra) {
            $productos->where(function($query) use($palabra){
                $query->orWhere('marca','LIKE','%'.utf8_encode($palabra).'%')->orWhere('titulo','LIKE','%'.utf8_encode($palabra).'%')->orWhere('modelo','LIKE','%'.utf8_encode($palabra).'%');
                $acentos=$this->PosiblesAcentos($palabra);
                foreach ($acentos as $ac) {
                    $query->orWhere('marca','LIKE','%'.utf8_encode($ac).'%')->orWhere('titulo','LIKE','%'.utf8_encode($ac).'%');
                }
            });
        }
        //dd($productos->paginate(9));
        $productos=$this->Ordenarresultados($productos->get(),$palabras);
        
        //Get current page form url e.g. &page=2, at default 1
        $currentPage=Input::get('page',1);

        //Define how many items to show in each page
        $perPage = 9;

        //Slice the collection according to per page
        $currentPageResults = $productos->slice(($currentPage-1)*$perPage,$perPage)->all();

        //Create the paginator and pass it to the view
        $paginatedResults= new LengthAwarePaginator($currentPageResults, count($productos),$perPage,$currentPage,['path'=>$request->url(),'query'=>$request->query()]);
        //dd($paginatedResults);

        return view('Tienda.tienda',['productos'=>$paginatedResults]);
    }

    public function Ordenarresultados(Collection $productos,$palabras)
    {
       // $word = "Many Blocks";
       //  if ( preg_match("~\bblocks\b~",$word) )
       //    dd("matched");
       //  else
       //    dd("no match");
        $matchResul=[];
        foreach ($productos as $key => $p) {
            $match=0;
            $titulo=str_replace(['/','-',' '],'-',utf8_decode($p->titulo));
            $product=strtolower($this->LimpiarAcentos($titulo));
            foreach ($palabras as $palabra) {
               $palabra=strtolower($this->LimpiarAcentos($palabra));
               if ( preg_match("~\b".$palabra."\b~",$product) )
               {
                $match++;
               }
               if(strpos($product, $palabra)===0)
               {
                $match++;
               }
           }
           $matchResul[]=$match;
        }
        //dd($productos[0]);
        arsort($matchResul);
        $keyOrder = array_keys($matchResul);
        $sorted=$productos->sortBy(function($model,$key) use ($keyOrder){
             return array_search($key, $keyOrder);

        });

        //dd($sorted);
        return $sorted;
    }

    public function LimpiarAcentos($string)
    {
        if(preg_match_all('/[áéíóú]/i',$string,$matches))
        {
            while(strpos($string, 'á')!==FALSE){
                $string=substr_replace($string,'a',strpos($string,'á'),2);
            }

            while(strpos($string, 'é')!==FALSE){
                $string=substr_replace($string,'e',strpos($string,'é'),2);
            }

            while(strpos($string, 'í')!==FALSE){
                $string=substr_replace($string,'i',strpos($string,'í'),2);
            }

            while(strpos($string, 'ó')!==FALSE){
                $string=substr_replace($string,'o',strpos($string,'ó'),2);
            }

            while(strpos($string, 'ú')!==FALSE){
                $string=substr_replace($string,'u',strpos($string,'ú'),2);
            }
            return $string;
        }
        else
        {
            return $string;
        }
    }
    public function PosiblesAcentos($string)
    {
        $resul=[];
        $original=$string;

        $i=0;
        while(strpos($string, 'a')!==FALSE){
            $resul[]=substr_replace($original,'á',strpos($string,'a')-$i,1);
            $string=substr_replace($string,'á',strpos($string,'a'),1);
            $i++;
        }

        $i=0;
        while(strpos($string, 'e')!==FALSE){
            $resul[]=substr_replace($original,'é',strpos($string,'e')-$i,1);
            $string=substr_replace($string,'é',strpos($string,'e'),1);
            $i++;
        }

        $i=0;
        while(strpos($string, 'i')!==FALSE){
            $resul[]=substr_replace($original,'í',strpos($string,'i')-$i,1);
            $string=substr_replace($string,'í',strpos($string,'i'),1);
            $i++;
        }

        $i=0;
        while(strpos($string, 'o')!==FALSE){
            $resul[]=substr_replace($original,'ó',strpos($string,'o')-$i,1);
            $string=substr_replace($string,'ó',strpos($string,'o'),1);
            $i++;
        }

        $i=0;
        while(strpos($string, 'u')!==FALSE){
            $resul[]=substr_replace($original,'ú',strpos($string,'u')-$i,1);
            $string=substr_replace($string,'ú',strpos($string,'u'),1);
            $i++;
        }

        return $resul;
    }
    /*BLOQUE DE CODIGO DE ARRIBA ES DE LA VERSION 6*/

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
