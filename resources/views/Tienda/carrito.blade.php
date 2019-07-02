@extends('principal')
@section('content')
<div class="card" style="width: 75%;">
  <div class="card-header">
    <h4>Carrito</h4>
  </div>
  <div class="card-body">
    	<table class="table">
			<thead>
				<tr>
				  <th scope="col">Producto</th>
				  <th scope="col">Precio c/u</th>
				  <th scope="col">Cantidad</th>
				  <th scope="col">Total</th>
				</tr>
			</thead>
			<tbody>
				@foreach($productos as $p)
					<tr>
					  <th scope="row">{{stripslashes(utf8_decode($p->titulo))}}</th>
					  <td>${{$p->costo}}</td>
					  <td><input type="number" name="cantidad" id="cantidad" min="1" value="1" style="width: 100px;"></td>
					  <td id="total">0</td>
					</tr>
				@endforeach
			</tbody>
		</table>
  </div>
</div>
	
		
@endsection