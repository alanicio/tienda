<div class="form-group col-md-4">
      <label for="inputColonia">Colonia</label>
      <select class="form-control" id="inputColonia" name="colonia" required="">
      	<option value="">Seleccione una colonia</option>
      	@foreach($colonias as $colonia)
      		<option value="{{$colonia}}">{{$colonia}}</option>
      	@endforeach
      </select>
  </div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="inputCity">Municipio o Delegacion</label>
    <input type="text" readonly="" id="inputCity" name="municipio" value="{{$municipio}}" class="form-control" required="">
  </div>

	<div class="form-group col-md-6">
	  <label for="inputState">Estado</label>
	  <input type="text" readonly="" id="inputState" name="estado" class="form-control" value="{{$estado}}" required="">    
	</div>
</div>