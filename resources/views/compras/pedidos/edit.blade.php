@extends ('layouts.admin')
@section('contenido')
   <div class="row">
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
           <h3>Editar Proveedor:{{$proveedor->nombre}}</h3>
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

    {!!Form::model($proveedor,['method'=>'PATCH','route'=>['proveedor.update',$proveedor->idProveedor]])!!}
    {!!Form::token()!!}
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre Proveedor</label>
                <input type="text" name="nombre" required value="{{$proveedor->nombre}}" class="form-control" placeholder="Nombre:">
            </div>
        </div>

       
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="stock">Domicilio</label>
                    <input type="text" name="domicilio"  value="{{$proveedor->domicilio}}" class="form-control" placeholder="Domicilio:">
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="stock">Telefono</label>
                    <input type="text" name="telefono"  value="{{$proveedor->telefono}}" class="form-control" placeholder="Telefono:">
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