@extends ('layouts.admin')
@section('contenido')
   <div class="row">
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
           <h3>Editar categoria:{{$categoria->tipo}}</h3>
           @if(count($errors)>0)
           <div class="alert alert-danger">
               <ul>
                   @foreach($errors->all() as $error)
                   <li>{{$error}}</li>
                   @endforeach
               </ul>
           </div>
           @endif

           <!-- {!!Form::model($categoria,['method'=>'PATCH','route'=>['categoria.update',$categoria->idTipoProducto]])!!} -->
           {!!Form::open(['action'=>['CategoriaController@update',$categoria->idTipoProducto],'method'=>'PATCH','files'=>true])!!}
           {!!Form::token()!!} 
           <div class="form-group">
               <label for="tipo">Tipo de Categori</label>
                <input type="text" name="tipo" class="form-control" value="{{$categoria->tipo}}" placeholder="Tipo:">
           </div>

           <div class="form-group">
               <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" class="form-control" value="{{$categoria->descripcion}}" placeholder="Descripcion:">
           </div>

           <div class="form-group">
               <button class="btn btn-primary" type="submit">Guardar</button>
               <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
           {!!Form::close()!!}
       </div>
   </div>
@stop