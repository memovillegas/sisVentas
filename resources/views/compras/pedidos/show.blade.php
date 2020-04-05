@extends ('layouts.admin')
@section('contenido')
 
            <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <label for="proveedor">Proveedor</label>
                    <p>{{$pedidoProducto->nombre}}</p>
                </div>
            </div>
           
        <div class="row">
            <div class="pane panel-prmary">
                <div class="panel-body">
                    
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: #A9D0F5;">
                                
                                <th>Artículos</th>
                                <th>Cantidad</th>
                                <th>Precio Compra</th>
                                <th>Precio Venta</th>
                                <th>Subtotal</th>
                            </thead>
                            <tfoot>
                              
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><h4 id="total">{{$pedidoProducto->total}}</h4></th>
                            </tfoot>
                            <tbody>
                            @foreach($detalles as $det)
                            <tr>
                                <td>{{$det->producto}}</td>
                                <td>{{$det->cantidad}}</td>
                                <td>{{$det->precioCompra}}</td>
                                <td>{{$det->precioVenta}}</td>
                                <td>{{$det->cantidad*$det->precioCompra}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            
        </div>   
@stop
