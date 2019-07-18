@extends('layouts.app')

@section('content')
<style>
.parallax {
  /* The image used */
  background-image: url("{{asset('imgs/Prototipo/p.jpg')}}");

  /* Set a specific height */
  min-height: 500px; 

  /* Create the parallax scrolling effect */
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: auto 85%;
}
</style>
<div class="parallax"></div>

<div style="height:auto;background-color: #7099de ;font-size:36px">
En Sistemas Nonex nos caracterizamos por una sencilla razón, sabemos que todo tiene solución.

Hacemos un enorme esfuerzo por mantener los costos bajos, pero la principal razón de trabajar con nosotros es de que entregaremos el proyecto como debe de ser, no creemos en los pretextos, creemos en nosotros y ustedes como clientes. Durante nuestra trayectoria hemos detallado nuestra forma de trabajo para que ustedes obtengan lo que invierten.
</div>
@endsection
