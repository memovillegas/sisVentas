@extends ('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Pedidos a Proveedores <a href="pedidos/create"><button class="btn btn-success">Nuevo Pedido</button></a></h3>
        @include('compras.pedidos.search')
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                    
                </thead>
                @foreach($pedidos as $ped)
                <tr>
                    <td>{{$ped->idPedidoProducto}}</td>
                    <td>{{$ped->fechaHora}}</td>
                    <td>{{$ped->nombre}}</td>
                    <td>{{$ped->total}}</td>
                    <td>{{$ped->estatus}}</td>
                    <td>
                        <a href="{{URL::action('PedidoProductoController@show',$ped->idPedidoProducto)}}"><button class="btn btn-primary">Detalles</button></a>
                        <a href="" data-target="#modal-delete-{{$ped->idPedidoProducto}}" data-toggle="modal"><button class="btn btn-danger">Cancelar Compra</button></a>
                    </td>
                </tr>
                @include ('compras.pedidos.modal')
                @endforeach
            </table>
        </div>
        <!--El metodo render sirve para hacer la paginacion en php-->
        {{$pedidos->render()}}
    </div>
</div>
@endsection