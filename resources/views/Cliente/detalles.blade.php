@extends('principal')
@section('content')
@php
  use App\Producto;
  $peso=0;
  $envio=0;
  if($venta->direccion->estado!='nonex')
  {
  	foreach($venta->productos as $p)
	  {
	    $peso+=$p->peso*$p->pivot->cantidad;

	  }
	  if($peso<=3 && $peso>0)
	  {
	    $envio=130;
	  }
	  elseif($peso<=7)
	  {
	    $envio=160;
	  }
	  elseif($peso<=13)
	  {
	    $envio=180;
	  }
	  elseif($peso<=19 || $peso==0)
	  {
	    $envio=340;
	  }
  }
  else
  {
  	$envio=0;
  }
  $envio*=1.16;
	  
@endphp
	<div class="card" style="width: 75%;">
		<div class="card-header">
			<a class="btn btn-primary" href="{{route('ventas.index')}}" role="button"><i class="fas fa-arrow-left"></i> Volver a historial</a>
			<h4 style="display: inline-block;">Compra #NX{{$venta->created_at->format('y')}}{{$venta->created_at->format('m')}}{{$venta->id+99}}</h4>
		</div>
		<div class="card-body">
			<table class="table">
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col">Producto</th>
			      <th scope="col">Precio unitario</th>
			      <th scope="col">Cantidad</th>
			      <th scope="col">Precio total</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach($venta->productos as $p)
					<tr>
						<td align="left">
						{{stripslashes(utf8_decode($p->titulo))}}<br><br>
						Marca: {{utf8_decode($p->marca)}}<br>
						Modelo: {{utf8_decode($p->modelo)}}<br><br>
						</td>
						<td align="center">${{number_format($p->pivot->precio_en_compra_MXN,2)}}</td>
						<td align="center">{{$p->pivot->cantidad}}</td>
						<td align="center">${{number_format(($p->pivot->precio_en_compra_MXN*$p->pivot->cantidad),2)}}</td>
						
					</tr>
	   			@endforeach
			  </tbody>
			</table>
			<div style="margin-left:30%;width: 28%;">
				<div><strong>Subtotal</strong> <div style="display: inline-block; float: right;">${{number_format($venta->totalMXN/1.16,2)}}</div></div>
				<div><strong>Costo de envío </strong><div style="display: inline-block; float: right">${{number_format($envio/1.16,2)}}</div></div>
				<div><strong>IVA </strong><div style="display: inline-block; float: right">${{number_format((($venta->totalMXN+$envio)/1.16)*0.16,2)}}</div></div>
				<div><strong>Total </strong><div style="display: inline-block; float: right">${{number_format($venta->totalMXN+$envio,2)}}</div></div>
			</div>
		</div>
	</div>
	
@endsection