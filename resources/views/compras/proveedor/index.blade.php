@extends ('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Proveedores <a href="proveedor/create"><button class="btn btn-success">Nuevo Proveedor</button></a></h3>
        @include('compras.proveedor.search')
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Domicilio</th>
                    <th>Telefono</th>
                   
                    <th>Activo</th>
                    <th>Opciones</th>
                    
                </thead>
                @foreach($proveedores as $pro)
                <tr>
                    <td>{{$pro->idProveedor}}</td>
                    <td>{{$pro->nombre}}</td>
                    <td>{{$pro->domicilio}}</td>
                    <td>{{$pro->telefono}}</td>
                    
                    <td>{{$pro->activo}}</td>
                    <td>
                        <a href="{{URL::action('ProveedorController@edit',$pro->idProveedor)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$pro->idProveedor}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                    </td>
                </tr>
                @include ('compras.proveedor.modal')
                @endforeach
            </table>
        </div>
        <!--El metodo render sirve para hacer la paginacion en php-->
        {{$proveedores->render()}}
    </div>
</div>
@endsection