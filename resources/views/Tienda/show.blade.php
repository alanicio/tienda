@extends('principal')
@section('content')





<div class="col-lg-9">

  <div class="card mt-4">
    <img class="card-img-top img-fluid" src="{{$producto->imagen}}" alt="">
    <div class="card-body">
      <a id="add_item" type="button" class="btn btn-success" style="float: right;"><i class="fas fa-cart-plus"></i> Añadir al carrito</a>
      <h3 class="card-title">{{stripslashes(utf8_decode($producto->titulo))}}</h3>
      <h4>${{$producto->costo}}</h4>
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
<!-- <script type="text/javascript">
  $.ajax({
    
  });
</script> -->
@endsection