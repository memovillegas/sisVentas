<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //Creacion de la tabla
    protected $table = 'tipoProducto';

    protected $primaryKey='idTipoProducto';
    
    public $timestamps = false;

    protected $fillable =[
        'tipo',
        'descripcion',
        'estatus'
    ];
}
