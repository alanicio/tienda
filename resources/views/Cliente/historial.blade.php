@extends('principal')
@section('content')

	<div class="card" style="width: 75%;">
		<div class="card-header">
			<h4>Historial</h4>
		</div>
		<div class="card-body">
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">Número de pedido</th>
			      <th scope="col">Fecha</th>
			      <th scope="col">Total</th>
			      <th scope="col">Dirección</th>
			      <th>Detalles</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@php
			  		$n=1;
			  	@endphp
			  	@foreach($ventas as $venta)
			  		<tr>
				      <th scope="row">#NX{{$venta->created_at->format('y')}}{{$venta->created_at->format('m')}}{{$venta->id+99}}</th>
				      <td>{{$venta->created_at->format('d/m/Y')}}</td>
				      <td>${{number_format($venta->totalMXN,2)}}</td>
				      @if($venta->direccion->estado=='nonex')
				      	<td>GRUPO DE INTEGRADORES NONEX S.A. DE C.V.<br>
						      Salaverry 987- 304 Lindavista entre Av. Ticomán y Calle. Salamina
						      C.P. 07300, Gustavo A. Madero, CDMX.<br><br></td>
					  @elseif($venta->direccion->estado=='comunicarse')
					  		<td>A tratar con agente de ventas</td>
				      @else
				      	<td>
				      		{{$venta->direccion->calle}}
							@if(isset($venta->direccion->num_int))
								{{$venta->direccion->num_ext}}-{{$venta->direccion->num_int}},
							@else
								{{$venta->direccion->num_ext}}
							@endif
							{{$venta->direccion->colonia}}, 
							{{$venta->direccion->codigo_postal}},  {{$venta->direccion->municipio}}, {{$venta->direccion->estado}} 
				      	</td>
				      @endif
				      
				      <td><a class="btn btn-primary" href="{{route('ventas.show',[$venta->id])}}" role="button"><i class="far fa-eye"></i></a></td>
				    </tr>
				@endforeach
				    
			  </tbody>
			</table>
		</div>
	</div>

<!-- <table class="table table-hover">
    <thead>
        <th></th><th></th><th></th>
    </thead>

    <tbody>
        <tr data-toggle="collapse" data-target="#accordionz" class="clickable">
            <td>Some Stuff</td>
            <td>Some more stuff</td>
            <td>And some more</td>
        </tr>
        <tr>
            <td>
                <div id="accordionz" class="collapse">Hidden by default</div>
            </td>
        </tr>
    </tbody>
</table> -->
<script type="text/javascript">
	$('#inicio').prop("class","nav-item");
	$('#tienda').prop("class","nav-item");
	$('#carrito').prop("class","nav-item");
	$('#usuario').prop("class","nav-item dropdown active");
	$('#sesion').prop("class","nav-item dropdown");
</script>
@endsection