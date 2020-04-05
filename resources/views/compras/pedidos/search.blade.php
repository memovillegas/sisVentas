{!!Form::open(array('url'=>'compras/pedidos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
<div class="form-group">
    <div class="input-group">
        <input type="text" class="form-control" name="searchText" placeholder="Buscar pedidos por nombre de proveedor:" value="{{$searchText}}">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Buscar Pedido</button>
        </span>
    </div>
</div>
{{Form::close()}}
