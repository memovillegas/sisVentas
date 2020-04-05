<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\EmpleadoFormRequest;
use DB;

class EmpleadoController extends Controller
{
    public function __construct(){
        // $this->middleware('auth');
   }
    public function index(Request $request)
    {
       if($request){
           //Determinar el texto de busqueda para fltrar la categoria
           $query = trim($request->get('searchText'));
           $empleados=DB::table('empleado')
           ->where('nombre','LIKE','%'.$query.'%')
           ->where('activo',1)
           ->orwhere('apePaterno','LIKE','%'.$query.'%')
           ->where('activo',1)
           ->orwhere('apeMaterno','LIKE','%'.$query.'%')
           ->where('activo',1)
           ->paginate(7);
           return view ('acceso.empleado.index',["empleados"=>$empleados,"searchText"=>$query]);
        }
    }

    public function create()
    {
        return view("acceso.empleado.create");
    }   
    // Almacenar el objeto del modelo categoria  en nuestra tabla categoria de nuestra BD
    public function store(EmpleadoFormRequest $request)
    {
        $empleado = new Empleado;
        $empleado->nombre=$request->get('nombre');
        $empleado->apePaterno=$request->get('apePaterno');
        $empleado->apeMaterno=$request->get('apeMaterno');
        $empleado->domicilio=$request->get('domicilio');
        $empleado->telefono=$request->get('telefono');
        $empleado->fechaIngreso=$request->get('fechaIngreso');
        $empleado->puesto=$request->get('puesto');
        $empleado->salario=$request->get('salario');
        $empleado->seguro=$request->get('seguro');
        $empleado->activo='1';
        $empleado->save();
        return Redirect::to('acceso\empleado');
    }
    public function show($id) 
    {
        return view("acceso.empleado.show",["empleado"=>Empleado::findorFail($id)]);
    }

    public function edit($id)
    {
        return view("acceso.empleado.edit",["empleado"=>Empleado::findorFail($id)]);
    }

    public function update(EmpleadoFormRequest $request,$id)
    {
        $empleado=Empleado::findorFail($id);
        $empleado->nombre=$request->get('nombre');
        $empleado->apePaterno=$request->get('apePaterno');
        $empleado->apeMaterno=$request->get('apeMaterno');
        $empleado->domicilio=$request->get('domicilio');
        $empleado->telefono=$request->get('telefono');
        $empleado->fechaIngreso=$request->get('fechaIngreso');
        $empleado->puesto=$request->get('puesto');
        $empleado->salario=$request->get('salario');
        $empleado->seguro=$request->get('seguro');
        $empleado->activo='1';
        $empleado->update();
        return Redirect::to('acceso/empleado');

        // $categoria=Categoria::findOrFail($id);
        // $categoria->nombre=$request->get('nombre');
        // $categoria->descripcion=$request->get('descripcion');
        // $categoria->update();
        // return view Redirect::to('almacen/categoria');
    }

    public function destroy($id)
    {
        $empleado=Empleado::findorFail($id);
        $empleado->activo='0';
        $empleado->update();
        //Redirige al index 
        return Redirect::to('acceso/empleado');
    }
}
