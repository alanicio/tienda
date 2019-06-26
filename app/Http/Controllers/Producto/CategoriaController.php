<?php

namespace App\Http\Controllers\Producto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categoria;

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
        //
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
        $fila = 0;
        
        //$categorias['nivel']=[];
        if (($gestor = fopen("data.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor)) !== FALSE) {
                if($fila)
                {
                    for($i=24;$i<=26;$i++)
                    {
                        $verificar=1;
                        $categorias=Categoria::get();
                        foreach ($categorias as $c ) {
                            if($c->nombre==$datos[$i])
                            {
                                $verificar=0;
                            }
                        }
                        if($verificar)
                        {
                            $categoria=new Categoria();
                            $categoria->nombre=$datos[$i];
                            $categoria->nivel=$i-23;
                            if($i>24)
                            {
                                //dd(Categoria::where('nombre',$datos[$i-1])->get('id')->toArray()[0]['id']);
                                $categoria->categoria_padre=Categoria::where('nombre',$datos[$i-1])->get('id')->toArray()[0]['id'];
                            }
                            $categoria->save();
                        }
                    }                        
                }
                $fila++;
            }
            fclose($gestor);
        }
        dd($categorias);

    }
}
