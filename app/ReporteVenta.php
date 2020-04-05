<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReporteVenta extends Model
{
    protected $table = 'reporte_venta';

    protected $primaryKey='idReporte_Venta';
    
    public $timestamps = false;

    protected $fillable =[
       'idVenta',
       'idProducto',
       'cantidad',
       'precioCompra',
       'precioVenta'
       
    ];
}
