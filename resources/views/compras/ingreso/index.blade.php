@extends ('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Ingresos <a href="ingreso/create"><button class="btn btn-success">Nuevo Ingreso</button></a></h3>
        @include('compras.ingreso.search')
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
                    <th>Numero Comprobante</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                    
                </thead>
                @foreach($ingresos as $ing)
                <tr>
                    <td>{{$ing->idingreso}}</td>
                    <td>{{$ing->fecha_hora}}</td>
                    <td>{{$ing->nombre}}</td>
                    <td>{{$ing->numComprobante}}</td>
                    <td>{{$ing->total}}</td>
                    <td>{{$ing->estatus}}</td>
                    <td>
                        <a href="{{URL::action('IngresoController@show',$ing->idingreso)}}"><button class="btn btn-primary">Detalles</button></a>
                        <a href="" data-target="#modal-delete-{{$ing->idingreso}}" data-toggle="modal"><button class="btn btn-danger">Cancelar Compra</button></a>
                    </td>
                </tr>
                @include ('compras.ingreso.modal')
                @endforeach
            </table>
        </div>
        <!--El metodo render sirve para hacer la paginacion en php-->
        {{$ingresos->render()}}
    </div>
</div>
@endsection