@extends('layouts.app')

@section('content')


<section class="bloque1">
	<img src="{{asset('imgs/inicio/logo1.png')}}" style="width: 150px;display: block;margin-left: auto;margin-right: auto;">
	<div style="text-align: center;margin-top: 50px;">
		<p style="color: white;text-shadow: 1px 0 10px  #ff8700;font-family:'Gotham Bold';font-size: 40px;">SOLUCIÓN A PROBLEMAS EN MATERIA DE TECNOLOGÍA</p>
	</div>
</section>

<section class="bloque2">
	<div>
		<div style="width: 100%;text-align: center"><br><h3>SERVICIOS</h3></div>
		<div class="row" style="margin-left: 25px;">	
			<div style="width: 30%;margin">
				<img src="{{asset('imgs/inicio/img1.png')}}" style="width: 20%;margin-left: 150px;margin-bottom: 10px;">
				<h3>CABLEADO ESTRUCTURADO</h3><p> Suministramos e instalamos cableado para proyectos de voz y datos. Contamos con certificaciones y personal apto para implementar los servicios de red	solicitados.</p>
			</div> 
			<div style="width: 30%;margin-left: 50px;">
				<img src="{{asset('imgs/inicio/img2.png')}}" style="width: 20%;margin-left: 150px;margin-bottom: 10px;">
				<h3>INTEGRACIÓN DE SISTEMAS</h3><p>Suministramos equipo electróni-
				co que cumpla con el funcionamiento de las redes tales como
				equipos de computo, monitoreo, servidores, routers, acces point, entre muchos otros equipos.</p>
			</div>
			<div style="width: 30%;margin-left: 50px;">
				<img src="{{asset('imgs/inicio/img3.png')}}" style="width: 20%;margin-left: 150px;margin-bottom: 10px;">
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
		<div style="text-align: center;width: 70%;margin-left: 100px;text">
			<br>
			<h3>SOBRE NOSOTROS</h3>
			<p>Nos caracterizamos por una sencilla razón, sabemos que todo tiene solu
			ción. Hacemos un enorme esfuerzo por mantener los costos bajos, pero la
			principal razón de trabajar con nosotros es de que entregaremos el proyecto como debe de ser, no creemos en los pretextos, creemos en nosotros y ustedes como clientes. Durante nuestra trayectoria hemos detallado nuestra
			forma de trabajo para que ustedes obtengan lo que invierten.</p>
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

@endsection
