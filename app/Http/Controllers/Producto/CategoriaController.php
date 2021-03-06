<?php

namespace App\Http\Controllers\Producto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categoria;
use App\Producto;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productos=Producto::where('categoria_id',$id)->orderBy('inventario','desc')->paginate(9);
        return view('Tienda.tienda',['productos'=>$productos]);
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

    public function CargarCategorias()
    {
         set_time_limit(20000);
          //file_put_contents("data.csv", file_get_contents("http://syscom.mx/principal/reporte_art_hora?cadena1=104511683&cadena2=ecab1f7d0a20621a021555208cf8b441&all=1&cadena3=1&alm=1&img=1&tc=1&ctg=8&sel=0"));
        $fila = 0;
        //  if (($gestor = fopen("data.csv", "r")) !== FALSE) {
        //     while (($datos = fgetcsv($gestor)) !== FALSE) {
        //         $fila++;
        //         for($i=0;$i<15;$i++)
        //         {
        //             echo $i." ".$datos[$i]."<br>";
        //         }
        //         if($fila>0)
        //         {
        //             break;
        //         }
        //     }
        //     fclose($gestor);
        //     dd('Categorias cargadas exitosamente');
        // }
        
        $categorias['nivel']=[];
        if (($gestor = fopen("data.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor)) !== FALSE) {
                echo $fila.'<br>';
                if($fila)
                {
                    for($i=12;$i<=14;$i++)
                    {
                        $verificar=1;
                        $categorias=Categoria::get();
                        foreach ($categorias as $c ) {
                            if($i==14 && ($datos[13]=='---' || $datos[13]=='Todos' || $datos[13]=='Todas' || $datos[13]=='Ver Todas' || $datos[13]=='Todo')) {
                                if(($c->nivel==2 && $c->nombre==$datos[$i] && $c->padre->nombre==$datos[$i-2]) || $datos[$i]=='---' || $datos[$i]=='Todos' || $datos[$i]=='Todas' || $datos[$i]=='Ver Todas' || $datos[$i]=='Todo')
                                {
                                    $verificar=0;
                                    break;
                                }
                            }
                            elseif ($i==14) {
                                if (($c->nivel==3 && $c->padre->nombre==$datos[$i-1] && $c->padre->padre->nombre==$datos[$i-2]) || $datos[$i]=='---' || $datos[$i]=='Todos' || $datos[$i]=='Todas' || $datos[$i]=='Ver Todas' || $datos[$i]=='Todo') {
                                    $verificar=0;
                                    break;
                                }
                            }
                            elseif($i==13)
                            {
                            
                                if(($c->nivel==2 && $c->nombre==$datos[$i] && ($c->padre->nombre==$datos[$i-1] || $c->padre->nombre==$datos[$i-2])) || $datos[$i]=='---' || $datos[$i]=='Todos' || $datos[$i]=='Todas' || $datos[$i]=='Ver Todas' || $datos[$i]=='Todo')
                                {
                                    $verificar=0;
                                    break;
                                }
                                
                                
                            }
                            else
                            {
                                if(($c->nombre==$datos[$i] || $datos[$i]=='---' || $datos[$i]=='Todos' || $datos[$i]=='Todas' || $datos[$i]=='Ver Todas') && $c->nivel==1)
                                {
                                    $verificar=0;
                                    break;
                                }
                            }

                                
                        }
                        if($verificar)
                        {
                            $categoria=new Categoria();
                            $categoria->nombre=$datos[$i];
                            $categoria->nivel=$i-11;
                            if($i==14 && ($datos[$i-1]=='---' || $datos[$i-1]=='Todos' || $datos[$i-1]=='Todas' || $datos[$i-1]=='Ver Todas' || $datos[$i-1]=='Todo'))
                            {
                                $padres=Categoria::where([['nombre',$datos[$i-2]],['nivel','<',2]])->get();
                                $categoria->nivel=2;
                                $categoria->categoria_padre=$padres->first()->id;
                                break;
                                     
                            }
                            elseif ($i==14) {
                                $padres=Categoria::where([['nombre',$datos[$i-1]],['nivel',2]])->get();
                                foreach ($padres as $padre) {
                                    // if(isset($padre->padre))
                                    // {
                                        if($padre->padre->nombre==$datos[$i-2])
                                        {
                                            $categoria->categoria_padre=$padre->id;
                                            break;
                                        }
                                   //  }
                                   //  else
                                   // {
                                   //      echo("informacion:<br>"."i=".$i);
                                   //      echo("<br>datos[$i]: ".$datos[$i]);
                                   //     dd($padre);
                                   // }

                                        
                                }
                            }
                            elseif($i==13)
                            {
                                $padre=Categoria::where([['nombre',$datos[$i-1]],['nivel','<',2]])->get();
                                $categoria->categoria_padre=$padre->first()->id;
                            }
                            $categoria->save();
                        }
                    }                        
                }
                $fila++;
                

                //echo $fila.'<br>';
                // if($fila==3000)
                //     break;

            }
            fclose($gestor);
            dd('Categorias cargadas exitosamente');
        }

    }
}
