<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProveedorFormRequest;
use DB;

class ProveedorController extends Controller
{
    public function __construct(){
        // $this->middleware('auth');
   }
    public function index(Request $request)
    {
       if($request){
          $query = trim($request->get('searchText'));
           $proveedores=DB::table('proveedores')
           ->where('nombre','LIKE','%'.$query.'%')
           ->where('activo',1)
           ->paginate(7);
           return view ('compras.proveedor.index',["proveedores"=>$proveedores,"searchText"=>$query]);
        }
    }

    public function create()
    {
        return view("compras.proveedor.create");
    }   
    // Almacenar el objeto del modelo categoria  en nuestra tabla categoria de nuestra BD
    public function store(ProveedorFormRequest $request)
    {
        $proveedor = new Proveedor;
        $proveedor->nombre=$request->get('nombre');
        $proveedor->domicilio=$request->get('domicilio');
        $proveedor->telefono=$request->get('telefono');
        // $proveedor->correo=$request->get('correo');
        // $proveedor->unidadMedida=$request->get('unidadMedida');
        $proveedor->activo='1';
        $proveedor->save();
        return Redirect::to('compras\proveedor');
    }
    public function show($id) 
    {
        return view("compras.proveedor.show",["proveedor"=>Proveedor::findorFail($id)]);
    }

    public function edit($id)
    {
        return view("compras.proveedor.edit",["proveedor"=>Proveedor::findorFail($id)]);
    }

    public function update(ProveedorFormRequest $request,$id)
    {
        $proveedor=Proveedor::findorFail($id);
        $proveedor->nombre=$request->get('nombre');
        $proveedor->domicilio=$request->get('domicilio');
        $proveedor->telefono=$request->get('telefono');

        $proveedor->activo='1';
        $proveedor->update();
        return Redirect::to('compras/proveedor');
    }

    public function destroy($id)
    {
        $proveedor=Proveedor::findorFail($id);
        $proveedor->activo='0';
        $proveedor->update();
        //Redirige al index 
        return Redirect::to('compras/proveedor');
    }
}
