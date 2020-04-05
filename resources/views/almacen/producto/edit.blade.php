@extends ('layouts.admin')
@section('contenido')
   <div class="row">
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
           <h3>Editar Producto:{{$producto->nombre}}</h3>
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

    {!!Form::model($producto,['method'=>'PATCH','route'=>['producto.update',$producto->idProducto],'files'=>true])!!}
    {!!Form::token()!!}
        <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre de producto</label>
                <input type="text" name="nombre" required value="{{$producto->nombre}}" class="form-control">
            </div>
        </div>
 
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="">Categoria</label>
                <select name="idTipoProducto" class="form-control" id="">
                @foreach($tipoProductos as $tp)
                @if($tp->idTipoProducto==$producto->idTipoProducto)
                <option value="{{$tp->idTipoProducto}}"selected>{{$tp->tipo}}</option>
                @else
                <option value="{{$tp->idTipoProducto}}">{{$tp->tipo}}</option>
                @endif
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="codigo">Presentación</label>
                    <input type="text" name="presentacion"  value="{{$producto->presentacion}}" class="form-control">
                </div>
            </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="codigo">Código</label>
                    <input type="text" name="codigo" required value="{{$producto->codigo}}" class="form-control">
                </div>
            </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="text" name="stock" required value="{{$producto->stock}}" class="form-control" readonly>
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="stock">Descripción</label>
                    <input type="text" name="descripcion"  value="{{$producto->descripcion}}" class="form-control" placeholder="Descripción del producto:">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen" class="form-control">
                    @if(($producto->imagen)!="")
                    <img src="{{asset('imagenes/productos/'.$producto->imagen)}}" height="300px" width="300px">
                    @endif
            </div>
        </div>

        <div class="col-lg-6 col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <br>
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
                </br>
            </div>
        </div>
        </div>
    </div>

           {!!Form::close()!!}
     
@stop