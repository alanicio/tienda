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
          <a href="{{isset($p->categoria)?url('/'.$categoria.'/'.$p->id.'-'.$titulo.'-'.$marca.'-'.$modelo):url('/otros/'.$p->id.'-'.$titulo.'-'.$marca.'-'.$modelo)}}"><img class="card-img-top" src="{{strlen($p->imagen)?$p->imagen:asset('imgs/not_found.png')}}" alt=""></a>
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
              
                @if($p->inventario>0)
                  <input type="number" name="{{$p->id}}" id="cantidad{{$p->id}}" min="1" value="{{Session::get('cantidadSeleccionada'.$p->id)>0?Session::get('cantidadSeleccionada'.$p->id):0}}" style="width: 30%;">
                  @php
                    $verificar=1;
                    foreach(array_slice(Session::all(), 4) as $id)
                    {
                      if($p->id==$id)
                      {
                        echo "<a id='".$p->id."' type='button' class='btn btn-success btn-sm disabled mt-auto text-center'><i class='fas fa-check-square'></i> Añadido al carrito</a>";
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
    var cantidad=$('#cantidad'+id).val();
    $.ajax({
        type: "POST",
        url: '{{url("/carrito")}}',
        data:{id:id,cantidad:cantidad},
        success: function(res){
          if(res.status>0)
          {
            $('#'+id).attr('class','btn btn-success btn-sm disabled mt-auto text-center');
            $('#'+id).html('<i class="fas fa-check-square"></i> Añadido al carrito');
            if($('#cantidad'+id).val()==0)
            {
              $('#cantidad'+id).val(1)
            }
          }
          else
          {
            swal("Existencias insuficientes", "¡No disponemos de las existencias suficientes!", "error")
            .then((value) => {
              location.reload(true);
            });
          }
        },
    });
  });

$('input').change(function(){
  var fila=$(this).attr('name');
  //console.log($('#'+fila).attr('class')=='btn btn-success btn-sm disabled mt-auto text-center');
    if($('#'+fila).attr('class')=='btn btn-success btn-sm disabled mt-auto text-center')
    {
      var cantidad=-1*(parseInt(this.value)-parseInt(this.defaultValue));
      this.defaultValue=this.value;
      $.ajax({
            type: "POST",
            url: '{{url("/convert_c")}}',
            data:{id:fila,cantidad:cantidad,numU:this.value},
            success: function(res){
              if(res.status)
              {
                // $('#total'+fila).html('$'+(parseFloat($('#'+fila).val())*res.costo).toFixed(2));
                // $('[id^=total]').each(function(index){
                //   //console.log($(this).html())
                //   total+=parseFloat($(this).html().replace('$',''));
                // });
                // //console.log(total);
                // $('#Ftotal').html('$'+total.toFixed(2));
                // $('#'+fila).defaultValue=$('#'+fila).value;
                 
              }
              else
              {
                // $('#'+fila).attr('readonly', true);
                swal("Existencias insuficientes", "¡No disponemos de las existencias suficientes!", "error")
            .then((value) => {
              location.reload(true);
            });
                // swal("Existencias insuficientes", "¡No disponemos de las existencias suficientes!", "error");
           //     setTimeout(function(){
              //     location.reload(true);
              // }, 2000);
                
              }

                
            },
        });
    }
      
      // var total=0;
      // 
  });
</script>


@endsection