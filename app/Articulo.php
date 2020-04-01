<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //Creacion de la tabla
    protected $table = 'articulo';

    protected $primaryKey='idarticulo';
    
    public $timestamps = false;

    protected $fillable =[
        'idcategoria',
        'codigo',
        'nombre',
        'presentacion',
        'stock',
        'descripcion',
        'imagen',
        'estado'
    ];

    protected $guarded = [];
}
