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
	  if($peso<=3)
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
	  elseif($peso<=19)
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
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<style type="text/css">
	h3,h5,h4,th,strong{
		font-family:'Gotham Bold';
	}
	td,p{
		font-family: 'Gotham Light';
	}
</style>
<link href="/font/gotham/gotham-font.css" rel="stylesheet">
<div style="width: 100%;height: 18%;margin-left: 15%;"><img src="{{ $message->embed(public_path() . '/imgs/logo.png') }}" style="width: 100px;float: left"><h3>Confirmación de pedido</h3></div>
<div style="margin-left: 15%;">
	<p>{{$venta->created_at}}</p>
</div>
<div style="margin-left: 15%">
	<div><h4>{{$venta->user->name}}, gracias por tu compra</h4></div>
	<h5 style="font-family: 'Gotham Light';">Número de pedido #NX{{$venta->created_at->format('y')}}{{$venta->created_at->format('m')}}{{$venta->id+99}}</h5>
	<p>Referencia telefónia:{{$venta->direccion->telefono}}</p>
	@if($venta->direccion->estado=='nonex')
		<p>Le enviaremos un correo de confirmación cuando pueda recoger su  pedido en:<br>GRUPO DE INTEGRADORES NONEX S.A. DE C.V.<br>
			      Salaverry 987- 304 Lindavista entre Av. Ticoman y Calle. Salamina
			      C.P. 07300, Gustavo A. Madero, CDMX.<br></p>
	@elseif($venta->direccion->estado=='comunicarse')
		<p>En breve un agente de ventas se comunicara con usted</p>
	@else
		<p>Se le hará llegar a:<br>
			{{$venta->direccion->calle}}, {{$venta->direccion->codigo_postal}}, {{$venta->direccion->num_ext}}, {{$venta->direccion->num_int}}, {{$venta->direccion->colonia}}, {{$venta->direccion->municipio}}, {{$venta->direccion->estado}} 
		</p>
	@endif
	<h5>Tipo de entrega</h5>
	<p>Terrestre</p>
	<h5>Metodo de pago</h5>
	<h4>Artículos</h4>
	<table border="1" style="width: 50%;">
		<thead style="margin: 15%;">
			<th>Articulo</th>
			<th>Precio c/u</th>
			<th>Cantidad</th>
			<th>Precio total</th>
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
	<br>

	<div style="margin-left: 40%;"><strong>Subtotal</strong> <div style="display: inline-block;margin-left: 65px">${{number_format($venta->totalMXN/1.16,2)}}</div></div>
	<div style="margin-left: 40%;"><strong>Costo de envio </strong><div style="display: inline-block;margin-left: 9px">${{number_format($envio/1.16,2)}}</div></div>
	<div style="margin-left: 40%;"><strong>Iva </strong><div style="display: inline-block;margin-left: 115px">${{number_format((($venta->totalMXN+$envio)/1.16)*0.16,2)}}</div></div>
	<div style="margin-left: 40%;"><strong>Total </strong><div style="display: inline-block;margin-left: 97px">${{number_format($venta->totalMXN+$envio,2)}}</div></div>
</div>
<br><br><br>

<footer style="background-color: #1D334C;">
  	<div style="text-align: center;">
  		<a href=" https://www.sistemasnonex.com/"><img src="{{ $message->embed(public_path() . '/imgs/footer/internet.png') }}" style="width: 40px;margin-left: 6px;margin-top: 2px;"></a>
  		<a href="http://192.168.2.114:8000/contacto"><img src="{{ $message->embed(public_path() . '/imgs/footer/mail.png')}}" style="width: 30px;margin-left: 6px;"></a>
  		<a href="https://www.sistemasnonex.com/blog/"><img src="{{$message->embed(public_path() . '/imgs/footer/blog.png')}}" style="margin-left: 6px;margin-top: 2px;"></a>
  		<a href="https://www.facebook.com/sistemas.nonex/"><img src="{{$message->embed(public_path() . '/imgs/footer/facebook.png')}}" style="margin-top: 2px;"></a>
  	</div>
  	<div style="text-align: center;color: white;margin-top: 10px;margin-bottom: 10px;font-family: 'Gotham Bold'">
  		SOLUCIÓN A PROBLEMAS EN MATERIA DE TECNOLOGÍA
  	</div>
  	<div style="text-align: center;color: white;font-family: 'Gotham Light'">
  		<span>ventas@sistemasnonex.com</span>
  		<span style="margin-left: 10px;">(0155) 2978-4919</span>
  	</div>
  	<div style="color: white;font-family: 'Gotham Light';margin-top: 20px;text-align: center;">
  		<div style="font-size: 12px">
	  		<span style="margin-left: 20px;">Condiciones de Uso y Venta</span>
			<span style="margin-left: 20px;">Aviso de privacidad</span>
			<span style="margin-left: 20px;">Área legal</span>
			<span style="margin-left: 20px;">Cookies</span>
			<span style="margin-left: 100px;">TODOS LOS DERECHOS RESERVADOS A GRUPO DE INTEGRADORES NONEX S.A DE C.V. | 2019</span>
		</div>
		
  	</div>
  	<br>
  </footer>