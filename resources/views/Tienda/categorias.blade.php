@php
	use App\Categoria;
	$categorias1=Categoria::where('nivel',1)->get();
@endphp
<div class="col-lg-3">

  <h1 class="my-4">Tienda nonex</h1>
  <div class="list-group">
  	<div id="accordion">
	  	@foreach($categorias1 as $c)
		  	<div class="card">
			   	<a href="#" class="list-group-item" data-toggle="collapse" data-target="#collapse{{$c->id}}" aria-expanded="true" aria-controls="collapse{{$c->id}}">{{$c->nombre}}</a>	    	
			    <div id="collapse{{$c->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
			      <div class="card-body">
			        @foreach($c->hijos as $h)
			      
  						<div id="accordion2">
			        		<a href="#" class="list-group-item" data-toggle="collapse" data-target="#collapse{{$h->id}}" aria-expanded="true" aria-controls="collapse{{$h->id}}">{{$h->nombre}}</a>
			        		<div id="collapse{{$h->id}}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion2">
			      				<div class="card-body">
			      					@php
			      						foreach($h->hijos as $n){
			      							echo '<a href="'.route('categorias.show',['id'=>$n->id]).'" class="list-group-item">'.$n->nombre.'</a><br>';
			      						}
			      					@endphp
			      				</div>
			      			</div>
			      		</div>
			   	
			        @endforeach
			      </div>
			    </div>
		  	</div>
	    @endforeach
	</div>
  </div>

</div>
<!-- /.col-lg-3 -->