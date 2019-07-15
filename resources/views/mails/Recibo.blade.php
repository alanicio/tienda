

<h3>{{$venta->user->name}} Gracias Por su compra<h3>

<h5>Pedido {{$venta->id}}</h5>

<h5>Tipo de entrega</h5>
<p>Terrestre</p>


<h5>Metodo de pago</h5>

<h4>Artículos</h4>


<table border="1" style="width: 50%;">
	<thead style="margin: 50px;">
		<th>Articulo</th>
		<th>Cantidad</th>
		<th>Precio</th>
	</thead>
	<tbody>
		@foreach($venta->productos as $p)
		<tr>
			<td align="left">
			{{stripslashes(utf8_decode($p->titulo))}}<br><br>
			Marca: {{utf8_decode($p->marca)}}<br>
			Modelo: {{utf8_decode($p->modelo)}}<br><br>
			</td>
			<td align="center">{{$p->pivot->cantidad}}</td>
			<td align="center">${{round($p->pivot->precio_en_compra_MXN,2)}}</td>
		</tr>
    @endforeach
	</tbody>
</table>
<br>

<div style="margin-left: 40%;"><strong>Subtotal</strong> <div style="display: inline-block;margin-left: 65px">${{round($venta->totalMXN,2)}}</div></div>
<div style="margin-left: 40%;"><strong>Costo de envio </strong><div style="display: inline-block;margin-left: 9px">${{round($venta->totalMXN,2)}}</div></div>
<div style="margin-left: 40%;"><strong>Iva </strong><div style="display: inline-block;margin-left: 115px">${{round($venta->totalMXN,2)}}</div></div>
<div style="margin-left: 40%;"><strong>Total </strong><div style="display: inline-block;margin-left: 97px">${{round($venta->totalMXN,2)}}</div></div>