@extends('principal')
@section('content')

<div class="col-lg-9">

  <div class="card mt-4">
    <img class="card-img-top img-fluid" src="{{$producto->imagen}}" alt="">
    <div class="card-body">
      @if(Auth::check())
        <a id="add_item" type="button" class="btn btn-success" style="float: right;"><i class="fas fa-cart-plus"></i> Añadir al carrito</a>
      @else
        <a id="add_item" type="button" class="btn btn-primary" style="margin-bottom: 50px;" href="{{Route('login')}}"><i class="fas fa-sign-in-alt"></i> Inicia sesión para comprar</a>

        <a id="add_item" type="button" class="btn btn-warning" style="margin-bottom: 50px;" href="{{Route('register')}}">¿No tienes cuenta?</a>
      @endif
      <h3 class="card-title">{{stripslashes(utf8_decode($producto->titulo))}}</h3>
      <h4>${{Currency::conv($from = 'USD', $to = 'MXN', $value = $producto->costo, $decimals = 2)}}</h4>
      <p class="card-text">{!!str_replace("'", "",stripslashes(str_replace('\n',"",utf8_decode($producto->descripcion))))!!}</p>
      <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
      4.0 stars
    </div>
  </div>
  <!-- /.card -->

  <div class="card card-outline-secondary my-4">
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
  </div>
  <!-- /.card -->

</div>
<!-- /.col-lg-9 -->
<script type="text/javascript">
  $('#add_item').click(function(){
    $.ajax({
        type: "GET",
        url: '{{url("/add_producto","$producto->id")}}',
        success: function(){
          $('#add_item').attr('class','btn btn-success disabled');
          $('#add_item').html('<i class="fas fa-check-square"></i> Añadido al carrito');
          //$("i").attr('class','fas fa-check-square');
        },
    });
  });
    
</script>
@endsection