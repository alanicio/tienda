<?php

namespace App\Http\Controllers\Venta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Venta;
use App\Producto;
use Auth;
use Session;

class DireccionController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if(Auth::check()) {
                return $next($request); 
            }
            return redirect('/');           
        });
    }
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
    public function create(Request $request)
    {
        //dd($request->all());
        if(Auth::check())
        {
            //dd(Auth::user()->id);
            //dd('esta logueado');
            $venta=new Venta();
            $venta->user_id=Auth::user()->id;
        }
        else
        {
            //dd('no esta logueado');
            return redirect('/login');
        }
        //dd(Session::get('cantidadSeleccionada'.$value);
        foreach ($request->id as $key => $value) {
            if((Session::get('cantidadSeleccionada'.$value)+Producto::find($value)->inventario)<$request->cantidad[$key])
            {
                return redirect()->route('ventas.create');
            }
            //if(Producto::find($value))
        }
        Session::put('Datos_de_compra',$request->all());
        return view('Tienda.direccion',);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        if($request->codigo_postal)
        {
            Session::put('direccion',$request->all());    
        }
        else
        {
            Session::put('direccion','nonex');  
        }
        $productos=Producto::findMany(Session::get('Datos_de_compra')['id']);
        return view('Tienda.confirmacion',['productos'=>$productos]);
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

    public function cp(Request $request)
    {
        //Con la api caida
        // $data=json_decode(file_get_contents('https://api-codigos-postales.herokuapp.com/v2/codigo_postal/'.$request->cp));
        // return view('Tienda.cp',['colonias'=>$data->colonias,'estado'=>$data->estado,'municipio'=>$data->municipio]);
        $fila=0;
        if (($gestor = fopen("cp.csv", "r")) !== FALSE)
        {
            while (($datos = fgetcsv($gestor)) !== FALSE)
            {
                if($fila)
                {
                    if ($datos[6]==$request->cp)
                    {
                        $colonias[]=$datos[7];
                        $municipio=$datos[3];
                        $estado=$datos[1];
                    }
                }
                $fila++;
            }   
            fclose($gestor);
        }
        if(!isset($colonias))
        {
            return view('Tienda.cp_error');
            
        }
        return view('Tienda.cp',['colonias'=>$colonias,'estado'=>$estado,'municipio'=>$municipio]);
    }
}
