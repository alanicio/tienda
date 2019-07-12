<h3>Gracias Por su compra<h3>

<table>
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

Tuvo un costo total de ${{$venta->totalMXN}}