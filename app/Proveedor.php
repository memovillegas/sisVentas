<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    protected $primaryKey='idProveedor';
    
    public $timestamps = false;

    protected $fillable =[
        'nombre',
        'domicilio',
        'telefono',
        'correo'
        
    ];
}
