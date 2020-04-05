@extends ('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Empleados <a href="empleado/create"><button class="btn btn-success">Nuevo Empleado</button></a></h3>
        @include('acceso.empleado.search')
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <!-- <th>Apellido Paterno</th>
                    <th>Apellido Materno</th> -->
                    <th>Domicilio</th>
                    <th>Telefono</th>
                    <th>FechaIngreso</th>
                    <th>Puesto</th>
                    <th>Salario</th>
                    <th>Seguro</th>
                    <th>Activo</th>
                    <th>Opciones</th>
                    
                </thead>
                @foreach($empleados as $emp)
                <tr>
                    <td>{{$emp->idEmpleado}}</td>
                    <td>{{$emp->nombre.' '.$emp->apePaterno.' '.$emp->apeMaterno}}</td>
                    <!-- <td>{{$emp->apePaterno}}</td>
                    <td>{{$emp->apeMaterno}}</td> -->
                    <td>{{$emp->domicilio}}</td>
                    <td>{{$emp->telefono}}</td>
                    <td>{{$emp->fechaIngreso}}</td>
                    <td>{{$emp->puesto}}</td>
                    <td>{{$emp->salario}}</td>
                    <td>{{$emp->seguro}}</td>
                    <td>{{$emp->activo}}</td>
                    <td>
                        <a href="{{URL::action('EmpleadoController@edit',$emp->idEmpleado)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$emp->idEmpleado}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                    </td>
                </tr>
                @include ('acceso.empleado.modal')
                @endforeach
            </table>
        </div>
        <!--El metodo render sirve para hacer la paginacion en php-->
        {{$empleados->render()}}
    </div>
</div>
@endsection