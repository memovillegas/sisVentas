<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProducto extends Model
{
    protected $table = 'pedidoproducto';

    protected $primaryKey='idPedidoProducto';
    
    public $timestamps = false;

    protected $fillable =[
       'idProveedor',
       'estatus',
       'fechaHora',
    ];
}
