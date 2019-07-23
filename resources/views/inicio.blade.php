@extends('layouts.app')

@section('content')


<section class="bloque1"></section>

<section class="bloque2">
	<div>
		<div style="width: 100%;text-align: center"><br><h3>SERVICIOS</h3></div>
		<div class="row" style="margin-left: 25px;">	
			<div style="width: 30%;margin">
				<img src="{{asset('imgs/inicio/img1.png')}}" style="width: 20%;margin-left: 150px;margin-bottom: 10px;">
				<h3>CABLEADO ESTRUCTURADO</h3> Suministramos e instalamos ca-
				bleado para proyectos de voz y
				datos. Contamos con certifica-
				ciones y personal apto para im-
				plementar los servicios de red
				solicitados.
			</div> 
			<div style="width: 30%;margin-left: 50px;">
				<img src="{{asset('imgs/inicio/img2.png')}}" style="width: 20%;margin-left: 150px;margin-bottom: 10px;">
				<h3>INTEGRACIÓN DE SISTEMAS</h3>Suministramos equipo electróni-
				co que cumpla con el funciona-
				miento de las redes tales como
				equipos de computo, monitoreo,
				servidores, routers, acces point,
				entre muchos otros equipos.
			</div>
			<div style="width: 30%;margin-left: 50px;">
				<img src="{{asset('imgs/inicio/img3.png')}}" style="width: 20%;margin-left: 150px;margin-bottom: 10px;">
				<h3>SEGURIDAD ELECTRÓNICA</h3>Venta e instalación de equipo de
				seguridad tal como cámaras,
				alarmas, detección de incendio,
				equipo táctico, equipo de escu-
				cha y monitoreo.
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
			Nos caracterizamos por una sencilla razón, sabemos que todo tiene solu
			ción. Hacemos un enorme esfuerzo por mantener los costos bajos, pero la
			principal razón de trabajar con nosotros es de que entregaremos el proyecto
			como debe de ser, no creemos en los pretextos, creemos en nosotros y uste-
			des como clientes. Durante nuestra trayectoria hemos detallado nuestra
			forma de trabajo para que ustedes obtengan lo que invierten.
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
