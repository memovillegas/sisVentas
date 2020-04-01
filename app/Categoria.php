<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //Creacion de la tabla
    protected $table = 'categoria';

    protected $primaryKey='idcategoria';
    
    public $timestamps = false;

    protected $fillable =[
        'nombre',
        'descripcion',
        'condicion'
    ];
}
