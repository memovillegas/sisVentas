@extends ('layouts.admin')
@section('contenido')
   <div class="row">
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
           <h3>Editar Artículo:{{$articulo->nombre}}</h3>
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

    {!!Form::model($articulo,['method'=>'PATCH','route'=>['articulo.update',$articulo->idarticulo],'files'=>true])!!}
    {!!Form::token()!!}
        <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre de artículo</label>
                <input type="text" name="nombre" required value="{{$articulo->nombre}}" class="form-control">
            </div>
        </div>
 
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="">Categoria</label>
                <select name="idcategoria" class="form-control" id="">
                @foreach($categorias as $cat)
                @if($cat->idcategoria==$articulo->idcategoria)
                <option value="{{$cat->idcategoria}}"selected>{{$cat->nombre}}</option>
                @else
                <option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
                @endif
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="codigo">Presentación</label>
                    <input type="text" name="presentacion"  value="{{$articulo->presentacion}}" class="form-control">
                </div>
            </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="codigo">Código</label>
                    <input type="text" name="codigo" required value="{{$articulo->codigo}}" class="form-control">
                </div>
            </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="text" name="stock" required value="{{$articulo->stock}}" class="form-control" readonly>
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="stock">Descripción</label>
                    <input type="text" name="descripcion"  value="{{$articulo->descripcion}}" class="form-control" placeholder="Descripción del artículo:">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen" class="form-control">
                    @if(($articulo->imagen)!="")
                    <img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" height="300px" width="300px">
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