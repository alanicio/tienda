@php
use App\Categoria;
$categorias=Categoria::where('nivel',1)->get();
@endphp
<div class="col-lg-3">

  <h1 class="my-4">Tienda nonex</h1>
  <div class="list-group">
  	
  	@foreach($categorias as $c)
	    <a href="#" class="list-group-item">{{$c->nombre}}</a>
	    <!-- <a href="#" class="list-group-item">Category 2</a>
	    <a href="#" class="list-group-item">Category 3</a> -->
    @endforeach
  </div>

</div>
<!-- /.col-lg-3 -->