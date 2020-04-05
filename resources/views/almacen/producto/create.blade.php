@extends ('layouts.admin')
@section('contenido')
   <div class="row">
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
           <h3>Nuevo Producto</h3>
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
           {!!Form::open(array('url'=>'almacen/producto','method'=>'POST','autocomplete'=>'off','files'=>true))!!}
           {!!Form::token()!!}
        <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre artículo</label>
                <input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre:">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="">Categoria</label>
                <select name="idTipoProducto" class="form-control" id="">
                @foreach($tipoProductos as $tp)
                <option value="{{$tp->idTipoProducto}}">{{$tp->tipo}}</option>
                @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="presentacion">Presentación</label>
                    <input type="text" name="presentacion"  value="{{old('presentacion')}}" class="form-control" placeholder="Presentación del artículo">
                </div>
        </div> 

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="codigo">Código</label>
                    <input type="text" name="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="Codigo del artículo:">
                </div>
            </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="text" name="stock" value="{{old('stock')}}" class="form-control" placeholder="Stock del artículo:" disabled>
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="stock">Descripción</label>
                    <input type="text" name="descripcion"  value="{{old('descripcion')}}" class="form-control" placeholder="Descripción del artículo:">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen" class="form-control">
            </div>
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

           
           {!!Form::close()!!}
       
@stop