<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table = 'ingreso';

    protected $primaryKey='idingreso';
    
    public $timestamps = false;

    protected $fillable =[
       'idProveedor',
       'numComprobante',
        'estatus',
        'fecha_hora',
        'totalPagar',
        'saldoPendiente'
    ];
}
