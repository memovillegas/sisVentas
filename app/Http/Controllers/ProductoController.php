<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\support\Facades\Redirect;
//Para poder subir la imagen desde la maquina del cliente 
use Illuminate\Support\Facades\Input;
//  use Input;
use App\Http\Requests\ProductoFormRequest;
use App\Producto;
use DB;
use Illuminate\Auth\Middleware\Authenticate;

class ProductoController extends Controller
{
    public function __construct(){
        //  $this->middleware('auth');
    }
  
    //Creamos un objeto '$request' para poderlo validar con nuestro archivo Request
    public function index(Request $request)
    {
       if($request){
           //Determinar el texto de busqueda para fltrar la categoria
           $query = trim($request->get('searchText'));
           $productos=DB::table('producto as p')
           ->join('tipoproducto as tp','p.idTipoProducto','=','tp.idTipoProducto')
           ->select('p.idProducto','p.nombre','p.presentacion','p.codigo','p.stock','tp.tipo as categoria','p.descripcion','p.imagen','p.estatus')
           ->where('p.nombre','LIKE','%'.$query.'%')
           ->orwhere('p.codigo','LIKE','%'.$query.'%')
           ->orwhere('tp.tipo','LIKE','%'.$query.'%')
            ->orderBy('idProducto','asc')
            ->paginate(7);
           return view ('almacen.producto.index',["productos"=>$productos,"searchText"=>$query]);
       }
    }

    public function create()
    {
        $tipoProductos = DB::table('tipoproducto')->where('estatus','=','1')->get();
        return view("almacen.producto.create",["tipoProductos"=>$tipoProductos]);
    }
    // Almacenar el objeto del modelo categoria  en nuestra tabla categoria de nuestra BD
    public function store(ProductoFormRequest $request)
    {
        $producto = new Producto;
        $producto->idTipoProducto=$request->get('idTipoProducto');
        $producto->presentacion=$request->get('presentacion'); 
        $producto->codigo=$request->get('codigo'); 
        $producto->nombre=$request->get('nombre'); 
        $producto->stock=$request->get('stock'); 
        $producto->descripcion=$request->get('descripcion'); 
        $producto->estatus='Activo';

        
        if($request->hasFile('imagen')){
            $file=$request->file('imagen');
            $file->move(public_path().'/imagenes/productos',$file->getClientOriginalName());
            $producto->imagen=$file->getClientOriginalName();
        }

        $producto->save();
        return Redirect::to('almacen\producto');
    }
    public function show($id) 
    {
        return view("almacen.producto.show",["producto"=>Producto::findorFail($id)]);
    }

    public function edit($id)
    {
        $producto=Producto::findOrFail($id);
        $tipoProductos=DB::table('tipoproducto')->where('estatus','=','1')->get();
        return view("almacen.producto.edit",["producto"=>$producto,"tipoProductos"=>$tipoProductos]);
    }

    public function update(ProductoFormRequest $request,$id)
    {
        $producto=Producto::findorFail($id);
        $producto->idTipoProducto=$request->get('idTipoProducto');
        $producto->codigo=$request->get('codigo'); 
        $producto->presentacion=$request->get('presentacion'); 
        $producto->nombre=$request->get('nombre'); 
        $producto->stock=$request->get('stock'); 
        $producto->descripcion=$request->get('descripcion'); 
        $producto->estatus='Activo';

        if($request->hasFile('imagen')){
            $file=$request->file('imagen');
            $file->move(public_path().'/imagenes/productos',$file->getClientOriginalName());
            $producto->imagen=$file->getClientOriginalName();
        }
        // if(Input::hasFile('imagen')){
        //     $file=Input::file('imagen');
        //     $file->move(public_path(),'/imagenes/articulos',$file->getClientOriginalName());
        //     $articulo->imagen=$file->getClientOriginalName();
        // }
        $producto->update();
        return Redirect::to('almacen/producto');
    }

    public function destroy($id)
    {
        $producto=Producto::findorFail($id);
        $producto->estatus='Inactivo';
        $producto->update();
        //Redirige al index 
        return Redirect::to('almacen/producto');

    }
}
