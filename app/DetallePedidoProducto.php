<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePedidoProducto extends Model
{
    protected $table = 'detallepedidoproducto';

    protected $primaryKey='iddetallePedidoProducto';
    
    public $timestamps = false;

    protected $fillable =[
       'idingreso',
       'idProducto',
       'cantidad',
       'precioCompra',
       'precioVenta'
       
    ];
}
