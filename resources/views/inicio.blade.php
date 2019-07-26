@extends('layouts.app')

@section('content')
<section class="bloque1"></section>

<section class="bloque2">
	<div style="margin-left: 5%;">
		<div style="margin-bottom: 10px;" class="text-center"><br><h2 style="color: white;margin-top: 2%;"><strong>SERVICIOS</strong></h2></div>
		<div class="row text-center" style="margin-left: 7%;" >
			<div style="width: 20%;margin: 60px;">
				<img src="{{asset('imgs/inicio/img1.png')}}" style="width: 20%;margin-bottom: 10px;" class="text-center">
				<h3>CABLEADO ESTRUCTURADO</h3><p style="font-size: 18px;"><strong>Suministramos e instalamos cableado para proyectos de voz y datos. Contamos con certificaciones y personal apto para implementar los servicios de red	solicitados.</strong></p>
			</div>
			<div style="width: 20%;margin: 60px;">
				<img src="{{asset('imgs/inicio/img2.png')}}" style="width: 20%;margin-bottom: 10px;" class="text-center">
				<h3>INTEGRACIÓN DE SISTEMAS</h3><p style="font-size: 18px;"><strong>Suministramos equipo electrónico que cumpla con el funcionamiento de las redes tales como
				equipos de computo, monitoreo, servidores, routers, acces point, entre muchos otros equipos.</strong></p>
			</div>
			<div style="width: 20%;margin: 60px;">
				<img src="{{asset('imgs/inicio/img3.png')}}" style="width: 20%;margin-bottom: 10px;" class="text-center">
				<h3>SEGURIDAD ELECTRÓNICA</h3><p style="font-size: 18px;"><strong>Venta e instalación de equipo de seguridad tal como cámaras, alarmas, detección de incendio,
				equipo táctico, equipo de escucha y monitoreo.</strong></p>
			</div>
		</div>
	</div>
	
</section>

<section class="bloque3">
	<div>
		<div style="float: right;">
		</div>
		<div class="text-center">
			<br>
			<div style="font-size: 25px;">
				<h2 style="margin-top: 2%;"><strong>SOBRE NOSOTROS</strong></h2>
				<div style="margin: 5%;">
					<p><strong>Nos caracterizamos por una sencilla razón, sabemos que todo tiene solución. Hacemos un enorme esfuerzo por mantener los costos bajos, pero la principal razón de trabajar con nosotros es de que entregaremos el proyecto como debe de ser, no creemos en los pretextos, creemos en nosotros y ustedes como clientes. Durante nuestra trayectoria hemos detallado nuestra forma de trabajo para que ustedes obtengan lo que invierten.</strong></p>
				</div>
			</div>
		</div>
	</div>
</section>



<section class="bloque4">
	<div>
		<img src="{{asset('imgs/inicio/familia.png')}}" style="float: right;visibility: hidden;">
		<div style="display: table-cell; width: 800px;height: 500px;font-size: 300px;vertical-align: bottom; ">
		</div>
	</div>
</section>

<script type="text/javascript">
	$('#inicio').prop("class","nav-item active");
	$('#tienda').prop("class","nav-item");
	$('#carrito').prop("class","nav-item");
	$('#usuario').prop("class","nav-item dropdown");
	$('#sesion').prop("class","nav-item dropdown");
</script>

@endsection
