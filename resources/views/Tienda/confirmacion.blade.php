@extends('layouts.app')
@section('content')
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
							<td>{{$p->titulo}}</td>
							<td>${{round($p->costoMXN,2)}}</td>
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
							<td>${{round($p->costoMXN*$cantidad,2)}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div>
			<h4>Direccion para entregar/recoger</h4>
			@if(Session::get('direccion')=='nonex')
				GRUPO DE INTEGRADORES NONEX S.A. DE C.V.<br>
			      Salaverry 987- 205 Lindavista entre Av. Ticoman y Calle. Salamina
			      C.P. 07300, Gustavo A. Madero, CDMX.<br><br>
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
			  <input type="text" readonly class="form-control-plaintext" id="subtotal" value="${{round($total/1.16,2)}}">
			</div>
		</div>
		<div class="form-group row">
			<label for="total" class="col-sm-2 col-form-label">Total</label>
			<div class="col-sm-10">
			  <input type="text" readonly class="form-control-plaintext" id="total" value="${{round($total,2)}}">
			</div>
		</div>
		<form action="{{route('ventas.store')}}" method="POST">
			@csrf
			<input class="btn btn-success" type="submit" value="Confirmar compra">
		</form>
			
			
	</div>
	
</div>
@endsection