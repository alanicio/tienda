@extends('layouts.app')
@section('content')
@php
  use App\Producto;
  $peso=0;
  $envio=0;
  if(Session::get('direccion')!='nonex')
  {
  	foreach(Session::get('Datos_de_compra')['id'] as $id)
	  {
	    $peso+=Producto::find($id)->peso*Session::get('cantidadSeleccionada'.$id);

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

  $envio*=1.16;
	  
@endphp
<div class="card">
	<div class="card-header">
		<h3>Favor de confirmar los datos de su compra</h3>
	</div>
	<div class="card-body">
		<div>
			<h4>Productos a comprar</h4>
			<table class="table">	
				<thead>
					<tr>
						<th>Modelo</th>
						<th>Marca</th>
						<th>Producto</th>
						<th>Precio individual</th>
						<th>Cantidad</th>
						<th>Precio total</th>
					</tr>
				</thead>
				<tbody>
					@foreach($productos as $p)
						<tr>
							<td>{{$p->modelo}}</td>
							<td>{{$p->marca}}</td>
							<td>{{stripslashes(utf8_decode($p->titulo))}}</td>
							<td>${{number_format($p->costoMXN,2)}}</td>
							<td>@php
								foreach(Session::get('Datos_de_compra')['id'] as $key=>$value)
								{
									if($value==$p->id)
									{
										$cantidad=Session::get('Datos_de_compra')['cantidad'][$key]; 
										echo $cantidad;
										break;
									}
								}
								@endphp
							</td>
							<td>${{number_format($p->costoMXN*$cantidad,2)}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div>
			<h4>Dirección para entregar/recoger</h4>
			<p>Referencia telefónica:{{Session::get('telefono')}}</p>
			@if(Session::get('direccion')=='nonex')
				GRUPO DE INTEGRADORES NONEX S.A. DE C.V.<br>
			      Salaverry 987- 304 Lindavista entre Av. Ticomán y Calle. Salamina
			      C.P. 07300, Gustavo A. Madero, CDMX.<br><br>
			@elseif(Session::get('direccion')=='comunicarse')
				<p>A tratar con agente de ventas</p>
			@else
				<form>
					<div class="row">
						<div class="col-auto">
					      <label class="sr-only" for="num_int">Numero interior</label>
					      <div class="input-group mb-2">
					        <div class="input-group-prepend">
					          <div class="input-group-text">Numero interior</div>
					        </div>
					        <input type="text" readonly="" value="{{Session::get('direccion')['num_int']}}" class="form-control" id="num_int">
					      </div>
					    </div>

						<div class="col-auto">
					      <label class="sr-only" for="num_ext">Numero exterior</label>
					      <div class="input-group mb-2">
					        <div class="input-group-prepend">
					          <div class="input-group-text">Numero exterior</div>
					        </div>
					        <input type="text" readonly="" value="{{Session::get('direccion')['num_ext']}}" class="form-control" id="num_ext">
					      </div>
					    </div>

					    <div class="col-auto">
					      <label class="sr-only" for="Calle">Calle</label>
					      <div class="input-group mb-2">
					        <div class="input-group-prepend">
					          <div class="input-group-text">Calle</div>
					        </div>
					        <input type="text" readonly="" value="{{Session::get('direccion')['calle']}}" class="form-control" id="Calle">
					      </div>
					    </div>
					</div>

					<div class="row">
						<div class="col-sm-5">
					      <label class="sr-only" for="colonia">Colonia</label>
					      <div class="input-group mb-2">
					        <div class="input-group-prepend">
					          <div class="input-group-text">Colonia</div>
					        </div>
					        <input type="text" readonly="" value="{{Session::get('direccion')['colonia']}}" class="form-control form-control" id="colonia">
					      </div>
					    </div>

					    <div class="col-auto">
					      <label class="sr-only" for="codigo_postal">Codigo postal</label>
					      <div class="input-group mb-2">
					        <div class="input-group-prepend">
					          <div class="input-group-text">Codigo postal</div>
					        </div>
					        <input type="text" readonly="" value="{{Session::get('direccion')['codigo_postal']}}" class="form-control" id="codigo_postal">
					      </div>
					    </div>
					</div>

					<div class="row">
						<div class="col-sm-5">
					      <label class="sr-only" for="municipio">Municipio</label>
					      <div class="input-group mb-2">
					        <div class="input-group-prepend">
					          <div class="input-group-text">Municipio</div>
					        </div>
					        <input type="text" readonly="" value="{{Session::get('direccion')['municipio']}}" class="form-control form-control" id="municipio">
					      </div>
					    </div>

					    <div class="col-sm-5">
					      <label class="sr-only" for="estado">Estado</label>
					      <div class="input-group mb-2">
					        <div class="input-group-prepend">
					          <div class="input-group-text">Estado</div>
					        </div>
					        <input type="text" readonly="" value="{{Session::get('direccion')['estado']}}" class="form-control form-control" id="estado">
					      </div>
					    </div>
					</div>
				</form>
			@endif
				
		</div>
		@php
			$total=0;
			foreach($productos as $key=>$p)
			{
				$total+=($p->costoMXN*(Session::get('Datos_de_compra')['cantidad'][$key]));
			}
		@endphp
		<div class="form-group row">
			<label for="subtotal" class="col-sm-2 col-form-label">Subtotal</label>
			<div class="col-sm-10">
			  <input type="text" readonly class="form-control-plaintext" id="subtotal" value="${{number_format($total/1.16,2)}}">
			</div>
		</div>
		<div class="form-group row">
			<label for="envio" class="col-sm-2 col-form-label">Costo de envio</label>
			<div class="col-sm-10">
			  <input type="text" readonly class="form-control-plaintext" id="envio" value="${{number_format($envio/1.16,2)}}">
			</div>
		</div>
		<div class="form-group row">
			<label for="iva" class="col-sm-2 col-form-label">IVA</label>
			<div class="col-sm-10">
			  <input type="text" readonly class="form-control-plaintext" id="iva" value="${{number_format((($total+$envio)/1.16)*0.16,2)}}">
			</div>
		</div>
		<div class="form-group row">
			<label for="total" class="col-sm-2 col-form-label">Total</label>
			<div class="col-sm-10">
			  <input type="text" readonly class="form-control-plaintext" id="total" value="${{number_format($total+$envio,2)}}">
			</div>
		</div>
		<form action="{{route('ventas.store')}}" method="POST">
			@csrf
			<input class="btn btn-success" type="submit" value="Confirmar compra">
			<a type="button" class="btn btn-warning" href="{{route('ventas.create')}}">Editar compra</a>
			<!-- <a type="button" class="btn btn-danger">Cancelar compra</a> -->
			<a href="javascript:history.back()" class="btn btn-info" role="button">Atras</a>
		</form>
			
			
	</div>
	
</div>


@endsection