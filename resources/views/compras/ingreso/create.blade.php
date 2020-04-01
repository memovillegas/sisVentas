@extends ('layouts.admin')
@section('contenido')
   <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Ingreso</h3>
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
            {!!Form::open(array('url'=>'compras/ingreso','method'=>'POST','autocomplete'=>'off'))!!}
            {!!Form::token()!!}
            <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <label for="proveedor">Prveedor</label>
                    <select name="idProveedor" id="idProveedor" class="form-control selectpicker">                        
                        @foreach($proveedores as $proveedor)
                        <option value="{{$proveedor->idProveedor}}">
                            {{$proveedor->nombre}}
                        </option>
                        @endforeach  
                    </select>
                </div>
            </div>
           
            
            
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label for="numComprobante">Numero Comprobante</label>
                    <input type="text" name="numComprobante" value="{{old('numComprobante')}}" class="form-control" placeholder="Numero de Comprobante:"/>                
                </div>                
            </div>
        </div>
        <div class="row">
            <div class="pane panel-prmary">
                <div class="panel-body">
                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                        <div class="form-group">
                            <label>Artículo</label>
                            <select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
                                @foreach($articulos as $articulo)
                                <option value="{{$articulo->idarticulo}}">
                                    {{$articulo->articulo}}
                                </option>
                                @endforeach
                            </select>
                        </div>                        
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="cantidad"/>                
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <div class="form-group">
                            <label for="precioCompra">Precio Compra</label>
                            <input type="number" name="pprecioCompra" id="pprecioCompra" class="form-control" placeholder="P. compra"/>               
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <div class="form-group">
                            <label for="precioVenta">Precio Venta</label>
                            <input type="number" name="pprecioVenta" id="pprecioVenta" class="form-control" placeholder="P. Venta"/> 
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <div class="form-group">                            
                            <button type="button" name="bt_add" id="bt_add" class="btn btn-primary">
                                Agregar
                            </button> 
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: #A9D0F5;">
                                <th>Opciones</th>
                                <th>Artículos</th>
                                <th>Cantidad</th>
                                <th>Precio Compra</th>
                                <th>Precio Venta</th>
                                <th>Subtotal</th>
                            </thead>
                            <tfoot>
                                <th>TOTAL</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><h4 id="total">$ 0.00</h4></th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
                <div class="form-group">
                    <input name="_token" value="{{csrf_token()}}" type="hidden"/>
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
                </div>
            </div>
        </div>        
{!!Form::close()!!}
@push('scripts')
<script>
  
    $(document).ready(function(){
       $("#bt_add").click(function(){
            agregar();
       });
    });
    var cont=0;
    var total=0;
    var subtotal=[];
    $("#guardar").hide();
    
    function agregar(){
        var idarticulo = $("#pidarticulo").val();
        articulo = $("#pidarticulo option:selected").text();
        cantidad = $("#pcantidad").val();
        precioCompra = $("#pprecioCompra").val();
        precioVenta = $("#pprecioVenta").val();
        
        if(idarticulo!="" && cantidad!="" && cantidad>0 && precioCompra!="" && precioVenta!=""){
            subtotal[cont] = (cantidad*precioCompra);
            total = total+subtotal[cont];
            
            var fila = '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">x</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precioCompra[]" value="'+precioCompra+'"></td><td><input type="number" name="precioVenta[]" value="'+precioVenta+'"></td><td>'+subtotal[cont]+'</td></tr>';
            cont++;
            limpiar();
            $("#total").html("S/. "+total);
            evaluar();
            $('#detalles').append(fila);
        }else{
            alert("Error al ingresar el detalle del ingreso, revise los datos del articulo");
        }
    }
    
    function limpiar(){
        $("#pcantidad").val("");
        $("#pprecioCompra").val("");
        $("#pprecioVenta").val("");
    }
    function evaluar(){
        if(total>0){
            $("#guardar").show();
        }else{
            $("#guardar").hide();
        }
    }
    function eliminar(index){
        total = total-subtotal[index];
        $("#total").html("S/."+total);
        $("#fila"+index).remove();
        evaluar();
    }
</script>

@endpush
@stop
