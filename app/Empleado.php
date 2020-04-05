<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
     //Creacion de la tabla
     protected $table = 'empleado';

     protected $primaryKey='idEmpleado';
     
     public $timestamps = false;
 
     protected $fillable =[
         'nombre',                  
         'apePaterno',
         'apeMaterno',
         'domicilio',
         'telefono',
         'fechaIngreso',
         'puesto',
         'salario',
         'seguro',        
     ];
}
