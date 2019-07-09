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
			      <th scope="col">#</th>
			      <th scope="col">Fecha de compra</th>
			      <th scope="col">Total</th>
			      <th>Ver Productos</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($ventas as $venta)
			  		<tr>
				      <th scope="row">{{$venta->id}}</th>
				      <td>{{$venta->created_at->format('d/m/Y')}}</td>
				      <td>${{round($venta->totalMXN,2)}}</td>
				      <td><i class="clickable far fa-arrow-alt-circle-down" data-toggle="collapse" data-target="#accordionV{{$venta->id}}"></i></td>
				    </tr>
				    <tr>
				    	<td colspan="4">
				    		<table class="collapse" id="accordionV{{$venta->id}}">
					    		<thead>
					    			<th>Marca</th>
					    			<th>Modelo</th>
					    			<th>Titulo</th>
					    			<th>Cantidad</th>
					    			<th>Costo en la compra</th>
					    		</thead>
					    		<tbody>
								    @foreach($venta->productos as $p)
							    		<tr>
							    			<td>{{utf8_decode($p->marca)}}</td>
							    			<td>{{utf8_decode($p->modelo)}}</td>
							    			<td>{{stripslashes(utf8_decode($p->titulo))}}</td>
							    			<td>{{$p->pivot->cantidad}}</td>
							    			<td>${{round($p->pivot->precio_en_compra_MXN,2)}}</td>
							    		</tr>
								    @endforeach
					    		</tbody>
					    	</table>
				    	</td>
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
		
@endsection