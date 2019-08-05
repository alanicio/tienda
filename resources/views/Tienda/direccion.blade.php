@extends('layouts.app')
@section('content')
@php

  use App\Producto;
  $peso=0;
  foreach(Session::get('Datos_de_compra')['id'] as $id)
  {
    $peso+=Producto::find($id)->peso*Session::get('cantidadSeleccionada'.$id);

  }
  

@endphp
  <form id="Direccion" style="margin:15%;" method="POST" action="{{url('venta/confirmacion')}}">
    @csrf
    <div class="form-group col-md-6">
      <div class="form-group col-md-6">
          <label for="inputTel">Teléfono</label>
          <input type="text" required class="form-control" id="inputTel" name="telefono">
      </div>
      <select id="Envio" class="form-control">
        <option selected value="">Seleccione la forma de envio</option>
        <option value="1">Recoger en sucursal sin costo</option>

        @if($peso<=19)
          <option value="2">Deseo que me lo envien (aplica costos de envio)</option>
        @endif
      </select>
    </div>
    <div id="nonexDireccion" style="display: none;">
      GRUPO DE INTEGRADORES NONEX S.A. DE C.V.
      Salaverry 987- 205 Lindavista entre Av. Ticoman y Calle. Salamina
      C.P. 07300, Gustavo A. Madero, CDMX.<br><br>
      @if($peso>19)
        <div class="input-group ">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <input type="checkbox" name="comunicate">
            </div>
          </div>
          <textarea class="form-control" aria-label="With textarea" readonly="">El producto no está disponible para envío, si desea un envío, marque aquí para que uno de nuestros asesores se comunique con usted</textarea>
        </div>
      @endif
      <button type="submit" class="btn btn-primary">Finalizar compra</button>
    </div>
    
    <div  id="envioForm" style="display: none;">
       <div class="form-group col-md-2">
            <label for="inputCP">Código postal</label>
            <input type="text" class="form-control" id="inputCP" name="codigo_postal" required="">
        </div>
      <div class="form-group">
        <label for="inputCalle">Calle</label>
        <input type="text" required="" class="form-control" id="inputCalle" name="calle">
      </div>
      <div class="row">
        <div class="form-group col-md-2">
            <label for="inputExt">Numero exterior</label>
            <input type="text" required="" class="form-control" id="inputExt" name="num_ext">
        </div>

        <div class="form-group col-md-2">
            <label for="inputInt">Numero interior</label>
            <input type="text" class="form-control" id="inputInt" name="num_int">
        </div>
      </div>
      <div id="data_from_cp">
        <div class="form-group col-md-4">
              <label for="inputColonia">Colonia</label>
              <select class="form-control" id="inputColonia" name="colonia" required="">
                <option value="">Seleccione una colonia</option>
              </select>
          </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputCity">Municipio o Delegacion</label>
            <input type="text" class="form-control" id="inputCity" name="municipio" readonly="" required="">
          </div>

        <div class="form-group col-md-6">
          <label for="inputState">Estado</label>
          <input type="text" readonly="" id="inputState" name="estado" class="form-control" required="">    
        </div>
      </div>  

      </div>
      <button type="submit" class="btn btn-primary">Finalizar compra</button>
    </div>
  </form>

  <script type="text/javascript">
    $('#inputCP').change(function(){
      var codigo_postal=this.value;
      $.ajax({
        type:"POST",
        url:"{{'/cp'}}",
        data:{cp:codigo_postal},
        success: function(res){
          $('#data_from_cp').html(res);
        },
      });
    });

    $('#Envio').change(function(){
      if(this.value==2)
      {
        $('#envioForm').show();
        // $('footer').
        $('#Direccion').css('margin', 5+'%');
        $('#nonexDireccion').hide();
        // //$("footer").css('position','relative');
        // $("footer").css('position','absolute');
      }
      else
      {
        $('#envioForm').hide();
        $('#Direccion').css('margin', 15+'%');
      }
      if(this.value==1)
      {
        $('#nonexDireccion').show();
        $('input').prop('required',false);
        $('select').prop('required',false);
        $('#inputTel').prop('required',true);
      }
      else
      {
        $('#nonexDireccion').hide(); 
      }
    });
  </script>
@endsection