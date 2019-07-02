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
        $productos=Producto::where('categoria_id',$id)->paginate(30);
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
        $fila = 0;
        
        //$categorias['nivel']=[];
        if (($gestor = fopen("data.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor)) !== FALSE) {
                echo $fila.'<br>';
                if($fila)
                {
                    for($i=24;$i<=26;$i++)
                    {
                        $verificar=1;
                        $categorias=Categoria::get();
                        foreach ($categorias as $c ) {
                            if($i==26 && ($datos[25]=='---' || $datos[25]=='Todos' || $datos[25]=='Todas' || $datos[25]=='Ver Todas' || $datos[25]=='Todo')) {
                                if(($c->nivel==2 && $c->nombre==$datos[$i] && $c->padre->nombre==$datos[$i-2]) || $datos[$i]=='---' || $datos[$i]=='Todos' || $datos[$i]=='Todas' || $datos[$i]=='Ver Todas' || $datos[$i]=='Todo')
                                {
                                    $verificar=0;
                                    break;
                                }
                            }
                            elseif ($i==26) {
                                if (($c->nivel==3 && $c->padre->nombre==$datos[$i-1] && $c->padre->padre->nombre==$datos[$i-2]) || $datos[$i]=='---' || $datos[$i]=='Todos' || $datos[$i]=='Todas' || $datos[$i]=='Ver Todas' || $datos[$i]=='Todo') {
                                    $verificar=0;
                                    break;
                                }
                            }
                            elseif($i==25)
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
                            $categoria->nivel=$i-23;
                            if($i==26 && ($datos[$i-1]=='---' || $datos[$i-1]=='Todos' || $datos[$i-1]=='Todas' || $datos[$i-1]=='Ver Todas' || $datos[$i-1]=='Todo'))
                            {
                                $padres=Categoria::where([['nombre',$datos[$i-2]],['nivel','<',2]])->get();
                                $categoria->nivel=2;
                                $categoria->categoria_padre=$padres->first()->id;
                                break;
                                     
                            }
                            elseif ($i==26) {
                                $padres=Categoria::where([['nombre',$datos[$i-1]],['nivel','<',3]])->get();
                                foreach ($padres as $padre) {
                                    if($padre->padre->nombre==$datos[$i-2])
                                    {
                                        $categoria->categoria_padre=$padre->id;
                                        break;
                                    }
                                }
                            }
                            elseif($i==25)
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
