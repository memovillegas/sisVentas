@extends ('layouts.admin')
@section('contenido')
   <div class="row">
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
           <h3>Nuevo Empleado</h3>
           @if(count($errors)>0)
           <div class="alert alert-danger">
               <ul>
                   @foreach($errors->all() as $error)
                   <li>{{$error}}</li>
                   @endforeach
               </ul>
           </div>
           @endif
        </div>
    </div>
            <!--'files'=>true:Sirve para decirle al servidor que estamos preparados para recibir imagenes
            en el formulario-->
           {!!Form::open(array('url'=>'acceso/empleado','method'=>'POST','autocomplete'=>'off'))!!}
           {!!Form::token()!!}
        <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre:">
            </div>
        </div>

        

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="presentacion">Apellido Paterno</label>
                    <input type="text" name="apePaterno"  value="{{old('apePaterno')}}" class="form-control" placeholder="Apellido Paterno">
                </div>
        </div> 

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="codigo">Apellido Materno</label>
                    <input type="text" name="apeMaterno" required value="{{old('apeMaterno')}}" class="form-control" placeholder="Apellido Materno">
                </div>
            </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="stock">Domicilio</label>
                    <input type="text" name="domicilio" required value="{{old('domicilio')}}" class="form-control" placeholder="Domicilio:">
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="stock">Telefono</label>
                    <input type="text" name="telefono"  value="{{old('telefono')}}" class="form-control" placeholder="Telefono:">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="stock">Fecha de Ingreso</label>
                    <input type="date" name="fechaIngreso"  value="{{old('fechaIngreso')}}" class="form-control" placeholder="Fecha de ingreso:">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="stock">Puesto</label>
                    <input type="text" name="puesto"  value="{{old('puesto')}}" class="form-control" placeholder="Puesto:">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="stock">Salario</label>
                    <input type="text" name="salario"  value="{{old('salario')}}" class="form-control" placeholder="Salario:">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="stock">Seguro</label>
                    <input type="text" name="seguro"  value="{{old('seguro')}}" class="form-control" placeholder="Seguro:">
            </div>
        </div>

        </div>
        <div class="col-lg-6 col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">    
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
                
            </div>
        </div>
    </div>

           
           {!!Form::close()!!}
       
@stop