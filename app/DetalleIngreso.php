<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $table = 'detalle_ingreso';

    protected $primaryKey='iddetalle_ ingreso';
    
    public $timestamps = false;

    protected $fillable =[
       'idingreso',
       'idarticulo',
       'cantidad',
       'precioCompra',
       'precioVenta'
       
    ];
}
