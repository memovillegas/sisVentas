<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //Creacion de la tabla
    protected $table = 'producto';

    protected $primaryKey='idProducto';
    
    public $timestamps = false;

    protected $fillable =[
        'idTipoProducto',
        'codigo',
        'nombre',
        'presentacion',
        'stock',
        'descripcion',
        'imagen',
        'estatus'
    ];

    protected $guarded = [];
}
