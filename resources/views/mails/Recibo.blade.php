<h3>{{$venta->user->name}} Gracias Por su compra<h3>

<h5>Pedido {{$venta->id}}</h5>

<h5>Tipo de entrega</h5>
<p>Terrestre</p>
<br><br>

<h5>Metodo de pago</h5>


<table>
	<thead>
		<th>Articulo</th>
		<th>Cantidad</th>
		<th>Precio</th>
	</thead>
	<tbody>
		@foreach($venta->productos as $p)
		<tr>
			<td rowspan="3">{{utf8_decode($p->marca)}}</td>
			{{utf8_decode($p->modelo)}}
			{{stripslashes(utf8_decode($p->titulo))}}
			<td>{{$p->pivot->cantidad}}</td>
			<td>${{round($p->pivot->precio_en_compra_MXN,2)}}</td>
		</tr>
    @endforeach
	</tbody>
</table>

Tuvo un costo total de ${{$venta->totalMXN}}