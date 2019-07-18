@extends('principal')
@section('keywords')
  @isset($producto->categoria)
    <meta name="keywords" content="{{stripslashes(utf8_decode($producto->titulo))}}, {{stripslashes(utf8_decode($producto->marca))}},{{stripslashes(utf8_decode($producto->modelo))}},{{$producto->categoria->nombre}},{{$producto->categoria->padre->nombre}}">
  @endisset

  @empty($producto->categoria)
    <meta name="keywords" content="{{stripslashes(utf8_decode($producto->titulo))}}, {{stripslashes(utf8_decode($producto->marca))}},{{stripslashes(utf8_decode($producto->modelo))}},otros">
  @endempty
@endsection


@section('content')

<div class="col-lg-9">

  <div class="card mt-4">
    <img class="card-img-top img-fluid" src="{{strlen($producto->imagen)?$producto->imagen:asset('imgs/not_found.jpeg')}}" alt="">
    <div class="card-body">
      @if(Auth::check())
        @if($producto->inventario>0)
          @php
            $verificar=1;
            foreach(array_slice(Session::all(), 4) as $id)
            {
              if($producto->id==$id)
              {
                echo '<a id="add_item" type="button" class="btn btn-success disabled" style="float: right;"><i class="fas fa-check-square"></i> Añadido al carrito</a>';
                $verificar=0;
                break;
              }
            }
            if($verificar)
            {
              echo ' <a id="add_item" type="button" class="btn btn-success" style="float: right;"><i class="fas fa-cart-plus"></i> Añadir al carrito</a>';
            }
          @endphp
        @else
          <a id="add_item" type="button" class="btn btn-danger disabled" style="float: right;"><i class="fas fa-times-circle"></i> Producto agotado</a>
        @endif
      @else
        <a id="add_item" type="button" class="btn btn-primary" style="margin-bottom: 50px;" href="{{Route('login')}}"><i class="fas fa-sign-in-alt"></i> Inicia sesión para comprar</a>

        <a id="add_item" type="button" class="btn btn-warning" style="margin-bottom: 50px;" href="{{Route('register')}}">¿No tienes cuenta?</a>
      @endif
      <h2>{{stripslashes(utf8_decode($producto->titulo))}}</h2>
      <h5>Marca: {{stripslashes(utf8_decode($producto->marca))}}</h5>
      <h5>Modelo: {{stripslashes(utf8_decode($producto->modelo))}}</h5>
      <br>
      <h5>Existencias: {{$producto->inventario}}</h5>
      <br>
      <h4 class="card-title">${{round($producto->costoMXN,2)}}</h4>
      <br>
      <p class="card-text">{!!str_replace("'", "",stripslashes(str_replace('\n',"",utf8_decode($producto->descripcion))))!!}</p>
     <!--  <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
      4.0 stars -->
    </div>
  </div>
  <!-- /.card -->

  <!-- <div class="card card-outline-secondary my-4">
    <div class="card-header">
      Product Reviews
    </div>
    <div class="card-body">
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
      <small class="text-muted">Posted by Anonymous on 3/1/17</small>
      <hr>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
      <small class="text-muted">Posted by Anonymous on 3/1/17</small>
      <hr>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
      <small class="text-muted">Posted by Anonymous on 3/1/17</small>
      <hr>
      <a href="#" class="btn btn-success">Leave a Review</a>
    </div>
  </div> -->
  <!-- /.card -->

</div>
<!-- /.col-lg-9 -->
<script type="text/javascript">
  $('#add_item').click(function(){
    $.ajax({
        type: "GET",
        url: '{{url("/add_producto","$producto->id")}}',
        success: function(res){
          if(res>0)
          {
            $('#add_item').attr('class','btn btn-success disabled');
            $('#add_item').html('<i class="fas fa-check-square"></i> Añadido al carrito');
          }
          else
          {
            swal("Se acaban de terminar existencias!", "los sentimos, acaban de seleccionar las ultimas existencias de este producto", "error");
             location.reload();
          }
        },
    });
  });
    
</script>
@endsection