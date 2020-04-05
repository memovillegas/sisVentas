<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'pedidoproducto';

    protected $primaryKey='idPedidoProducto';
    
    public $timestamps = false;

    protected $fillable =[
       'estatus',
       'fechaHora',
       'totalVenta'
    ];
}
