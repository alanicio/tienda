<?php

namespace App\Http\Controllers\Venta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers;
use Session;
use App\Producto;
use App\Venta;
use App\User;
use App\productos_ventas;
use Illuminate\Support\Facades\Auth;
use Currency;
use App\Mail\ReciboDeCompra;
use Mail;

class VentaController extends Controller
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
        //dd(Producto::findMany(array_slice(Session::all(), 3)));
        
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
        $productos=Producto::findMany($request->id);
        $totalMXN=0;
        $totalUSD=0;
        //dd($request->cantidad);
        foreach ($productos as $index=>$p) {
            $totalMXN+=($p->costoMXN*$request->cantidad[$index]);
            $totalUSD+=($p->costoUSD*$request->cantidad[$index]);
        }
        $venta->totalMXN=$totalMXN;
        $venta->totalUSD=$totalUSD;
        $venta->save();
        foreach ($productos as $index=>$p) {
            $pivote=new productos_ventas();
            $pivote->producto_id=$p->id;
            $pivote->precio_en_compra_USD=$p->costoUSD;
            $pivote->precio_en_compra_MXN=$p->costoMXN;
            $pivote->venta_id=$venta->id;
            $pivote->cantidad=$request->cantidad[$index];
            $pivote->save();
        }
        $i=0;
        foreach (Session::all() as $key => $value) {
            if(strpos($key,'roducto'))
            {
                Session::forget('producto'.$value);
            }
            if(strpos($key,'Original'))
            {
                Session::forget('cantidadOriginal'.$value);
            }
            if(strpos($key,'Seleccionada'))
            {
                Session::forget('cantidadSeleccionada'.$value);
            }
        }
        //return view('mails.Recibo',['venta'=>$venta]);
        $this->Nonextore($venta);
        return $this->show(Auth::User()->id);
    }

    //Enviar correo de la venta realizada
    public function Nonextore(Venta $venta)
    {
        Mail::to($venta->user->email)->send(new ReciboDeCompra($venta));
        return $this->show(Auth::User()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Cliente.historial',['ventas'=>User::find($id)->ventas]);
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

    public function AddCarrito($id)
    {
        $producto=Producto::find($id);
        if($producto->inventario>0)
        {
            Session::put('producto'.$id,$id);
            Session::put('cantidadOriginal'.$id,$producto->inventario);
            $producto->inventario-=1;
            $producto->update();
            return 1;
        }
        else
        {
            return 0;
        }
            
    }

    public function RmCarrito($id)
    {
        $producto=Producto::find($id);
        $producto->inventario=Session::get('cantidadOriginal'.$id);
        $producto->update();
        Session::forget('producto'.$id);
        Session::forget('cantidadOriginal'.$id);
        Session::forget('cantidadSeleccionada'.$id);
    }

    public function ConvertC(Request $request)
    {
        session_start();
        $producto=Producto::find($request->id);
        if((-1*($request->cantidad))<0)
        {
            $producto->inventario+=$request->cantidad;
            $producto->update();
            $resul=[
                'status'=>1,
                'costo'=>$producto->costoMXN,
                'inventario'=>$producto->inventario,
                ];
        }
        else
        {
            if(($request->cantidad*-1)>$producto->inventario+1)
                $resul=['status'=>0];
            else
            {
                $producto->inventario+=$request->cantidad;
                $producto->update();
                $resul=[
                    'status'=>1,
                    'costo'=>$producto->costoMXN,
                    'inventario'=>$producto->inventario,
                    ];
            }
        }
        Session::put('cantidadSeleccionada'.$producto->id,$request->numU);
        return response()->json($resul);
    }
}
