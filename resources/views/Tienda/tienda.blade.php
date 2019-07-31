@extends('principal')
@section('content')

@php
use \App\Http\Controllers\Producto\ProductoController;
@endphp



<div class="col-lg-9">

  <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <!-- 900x350 imagenes del slider -->
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active">
        <img class="d-block img-fluid" src="{{asset('imgs/banner/banner1.png')}}" alt="First slide" style="width: 900px;height: 350px;">
      </div>
      <div class="carousel-item">
        <img class="d-block img-fluid" src="{{asset('imgs/banner/banner2.png')}}" alt="Second slide" style="width: 900px;height: 350px;">
      </div>
      <div class="carousel-item">
        <img class="d-block img-fluid" src="{{asset('imgs/banner/banner3.png')}}" alt="Third slide" style="width: 900px;height: 350px;">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <div class="row">


    @foreach($productos as $p)
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
         @php
            if(isset($p->categoria))
            {
              $categoria=stripslashes(str_replace(['/',' '],'-',$p->categoria->nombre));
              $categoria = preg_replace('~-{2,}~', '-', $categoria);
            }
            $titulo=stripslashes(str_replace(['/','-',' '],'-',utf8_decode($p->titulo)));
            $titulo = preg_replace('~-{2,}~', '-', $titulo);
            $titulo=str_replace([',','(',')','.'],'',$titulo);
            $titulo=ProductoController::LimpiarAcentos($titulo);
            $marca=stripslashes(str_replace(['/','-',' '],'-',utf8_decode($p->marca)));
            $marca = preg_replace('~-{2,}~', '-', $marca);
            $modelo=stripslashes(str_replace(['/','-',' '],'',utf8_decode($p->modelo)));
            $modelo = preg_replace('~-{2,}~', '-', $modelo);


         @endphp
          <a href="{{isset($p->categoria)?url('/'.$categoria.'/'.$p->id.'-'.$titulo.'-'.$marca.'-'.$modelo):url('/otros/'.$p->id.'-'.$titulo.'-'.$marca.'-'.$modelo)}}"><img class="card-img-top" src="{{strlen($p->imagen)?$p->imagen:asset('imgs/not_found.jpeg')}}" alt=""></a>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">
              <a href="{{isset($p->categoria)?url('/'.$categoria.'/'.$p->id.'-'.$titulo.'-'.$marca.'-'.$modelo):url('/otros/'.$p->id.'-'.$titulo.'-'.$marca.'-'.$modelo)}}">{{stripslashes(utf8_decode($p->titulo))}}</a>
            </h5>

            
            <p class="card-text">Modelo: {{utf8_decode($p->modelo)}}<br>Marca:{{utf8_decode($p->marca)}}</p>
            @if($p->costoMXN>0 && $p->inventario>0)
              <h5><strong>${{number_format($p->costoMXN,2)}}</strong></h5>
            @else
              <h5>Sin inventario</h5>
            @endif
            Existencias: <strong>{{number_format($p->inventario)}}</strong>
            <div class=" mt-auto text-center">
              @if(Auth::check())
                @if($p->inventario>0)
                  @php
                    $verificar=1;
                    foreach(array_slice(Session::all(), 4) as $id)
                    {
                      if($p->id==$id)
                      {
                        echo '<a id="add_item" type="button" class="btn btn-success disabled mt-auto text-center"><i class="fas fa-check-square"></i> Añadido al carrito</a>';
                        $verificar=0;
                        break;
                      }
                    }
                    if($verificar)
                    {
                      echo "<a id='".$p->id."' type='button' class='btn btn-success btn-sm' style='float: right;'><i class='fas fa-cart-plus'></i> Añadir al carrito</a>";
                    }
                  @endphp
                @else
                  <a id="" type="button" class="btn btn-danger disabled" style="float: right;"><i class="fas fa-times-circle"></i> Producto agotado</a>
                @endif
              @else
                <a id="" type="button" class="btn btn-primary btn-sm" style="margin-bottom: 10px;" href="{{Route('login')}}"><i class="fas fa-sign-in-alt"></i> Inicia sesión para comprar</a>

                <a id="" type="button" class="btn btn-warning btn-sm" style="margin-bottom: 10px;" href="{{Route('register')}}">¿No tienes cuenta?</a>
              @endif
            </div>
          </div>
          <!-- <div class="card-footer">
            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
          </div> -->
        </div>
      </div>
    @endforeach
    {{$productos->appends(Request::except('page'))->links()}}  
    {{isset($start)?microtime(true)-$start:''}}
  </div>
  <!-- /.row -->

</div>
<!-- /.col-lg-9 -->


<script type="text/javascript">
  $('#inicio').prop("class","nav-item");
  $('#tienda').prop("class","nav-item active");
  $('#carrito').prop("class","nav-item");
  $('#usuario').prop("class","nav-item dropdown");
  $('#sesion').prop("class","nav-item dropdown");

  $('.btn-success').click(function(){
    var id=$(this).attr('id');
    $.ajax({
        type: "GET",
        url: '{{url("/add_producto")}}'+'/'+id,
        success: function(res){
          if(res>0)
          {
            $('#'+id).attr('class','btn btn-success disabled');
            $('#'+id).html('<i class="fas fa-check-square"></i> Añadido al carrito');
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