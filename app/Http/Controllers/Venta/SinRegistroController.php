<?php

namespace App\Http\Controllers\Venta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Producto;
use Session;

class SinRegistroController extends Controller
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
        $ids=[];
        foreach (Session::all() as $key => $value) {
            if(strpos($key,'roducto'))
            {
                $ids[]=$value;
            }
        }
        //dd($ids);
        return view('Tienda.carrito',['productos'=>Producto::findMany($ids)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id=$request->id;
        $producto=Producto::find($request->id);
        if($request->cantidad==0)
        {
            $cantidad=1;
        }
        elseif ($request->cantidad>0) {
            $cantidad=$request->cantidad;
        }
        else
        {
            return response()->json(['status'=>0]);
        }
        if($producto->inventario>0 && $cantidad<=$producto->inventario)
        {
            Session::put('Tproducto'.$id,$id);
            Session::put('TcantidadOriginal'.$id,$producto->inventario);
            Session::put('TcantidadSeleccionada'.$id,$cantidad);
            // $producto->inventario-=$cantidad;
            // $producto->update();
            $resul=['status'=>1];
        }
        else
        {
            $resul=['status'=>0];
        }
        return response()->json($resul);
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
}
