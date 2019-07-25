@extends('layouts.app')
@section('content')

<form method="POST" action="{{route('contacto')}}">
	@csrf
	<div style="margin: 5%;">
	  <div class="form-group">
	    <label for="exampleFormControlInput1">Nombre</label>
	    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Ingrese su nombre" name="nombre">
	  </div>
	  <div class="form-group">
	    <label for="exampleFormControlInput2">Correo</label>
	    <input type="email" class="form-control" id="exampleFormControlInput2" placeholder="Ingrese su correo de contacto" name="correo">
	  </div>
	  <div class="form-group">
	    <label for="exampleFormControlTextarea1">Su mensaje</label>
	    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Diganos en que podemos ayudarlo" name="mensaje"></textarea>
	  </div>
	  <div class="text-center">
	  	<input type="submit" value="Enviar">
	  </div>
	</div>
</form>

@endsection