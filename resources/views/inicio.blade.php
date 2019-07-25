@extends('layouts.app')

@section('content')
<style type="text/css">
	p,h3{
		color: #1D334C;
	}
	h3{
		font-size: 25px;
	}
	p{
		text-align: justify;
  		/*text-justify: inter-word;*/
	}
</style>

<section class="bloque1">
	<img src="{{asset('imgs/inicio/logo1.png')}}" style="width: 150px;display: block;margin-left: auto;margin-right: auto;">
	<div style="text-align: center;margin-top: 50px;">
		<p style="color: white;text-shadow: 1px 0 10px  #ff8700;font-family:'Gotham Bold';font-size: 40px;" class="text-center">SOLUCIÓN A PROBLEMAS EN MATERIA DE TECNOLOGÍA</p>
	</div>
</section>

<section class="bloque2">
	<div style="margin-left: 5%;">
		<div style="margin-bottom: 10px;" class="text-center"><br><h3>SERVICIOS</h3></div>
		<div class="row text-center" >	
			<div style="width: 30%;margin">
				<img src="{{asset('imgs/inicio/img1.png')}}" style="width: 20%;margin-bottom: 10px;" class="text-center">
				<h3>CABLEADO ESTRUCTURADO</h3><p> Suministramos e instalamos cableado para proyectos de voz y datos. Contamos con certificaciones y personal apto para implementar los servicios de red	solicitados.</p>
			</div> 
			<div style="width: 30%;margin-left: 50px;">
				<img src="{{asset('imgs/inicio/img2.png')}}" style="width: 20%;margin-bottom: 10px;" class="text-center">
				<h3>INTEGRACIÓN DE SISTEMAS</h3><p>Suministramos equipo electrónico que cumpla con el funcionamiento de las redes tales como
				equipos de computo, monitoreo, servidores, routers, acces point, entre muchos otros equipos.</p>
			</div>
			<div style="width: 30%;margin-left: 50px;">
				<img src="{{asset('imgs/inicio/img3.png')}}" style="width: 20%;margin-bottom: 10px;" class="text-center">
				<h3>SEGURIDAD ELECTRÓNICA</h3><p>Venta e instalación de equipo de
				seguridad tal como cámaras, alarmas, detección de incendio,
				equipo táctico, equipo de escucha y monitoreo.</p>
			</div>
		</div>
	</div>
	<hr style="margin-top: 50px;">
	<div>
		<div style="float: right;">
			<img src="{{asset('imgs/inicio/we.png')}}" style="float:right;width:200px;">
		</div>
		<div style=";margin-left: 100px;" class="text-center">
			<br>
			<h3>SOBRE NOSOTROS</h3>
			<p>Nos caracterizamos por una sencilla razón, sabemos que todo tiene solución. Hacemos un enorme esfuerzo por mantener los costos bajos, pero la principal razón de trabajar con nosotros es de que entregaremos el proyecto como debe de ser, no creemos en los pretextos, creemos en nosotros y ustedes como clientes. Durante nuestra trayectoria hemos detallado nuestra forma de trabajo para que ustedes obtengan lo que invierten.</p>
		</div>
	</div>
</section>

<!-- <section class="bloque3">
	<div style="width: 100%;text-align: center"><h3>Experiencia y satisfacción.</h3></div>
	<div style="margin-left: 350px;">
		<img src="{{asset('imgs/inicio/f1.png')}}" style="width: 15%;margin-left: 5px;margin-bottom: 10px;">
		<img src="{{asset('imgs/inicio/f2.png')}}" style="width: 15%;margin-left: 5px;margin-bottom: 10px;">
		<img src="{{asset('imgs/inicio/f3.png')}}" style="width: 15%;margin-left: 5px;margin-bottom: 10px;">
		<img src="{{asset('imgs/inicio/f4.png')}}" style="width: 15%;margin-left: 5px;margin-bottom: 10px;">
	</div>
	<div style="margin-left: 350px;">
		<img src="{{asset('imgs/inicio/f5.png')}}" style="width: 15%;margin-left: 5px;margin-bottom: 10px;">
		<img src="{{asset('imgs/inicio/f6.png')}}" style="width: 15%;margin-left: 5px;margin-bottom: 10px;">
		<img src="{{asset('imgs/inicio/f7.png')}}" style="width: 15%;margin-left: 5px;margin-bottom: 10px;">
		<img src="{{asset('imgs/inicio/f8.png')}}" style="width: 15%;margin-left: 5px;margin-bottom: 10px;">
	</div>
</section> -->



<section class="bloque4"></section>

<script type="text/javascript">
	$('#inicio').prop("class","nav-item active");
	$('#tienda').prop("class","nav-item");
	$('#carrito').prop("class","nav-item");
	$('#usuario').prop("class","nav-item dropdown");
	$('#sesion').prop("class","nav-item dropdown");
</script>

@endsection
