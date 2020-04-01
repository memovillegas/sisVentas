<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Redirect;
//Para poder subir la imagen desde la maquina del cliente 
use Illuminate\Support\Facades\Input;
//  use Input;
use App\Http\Requests\ArticuloFormRequest;
use App\Articulo;
use DB;
use Illuminate\Auth\Middleware\Authenticate;

class ArticuloController extends Controller
{
    public function __construct(){
         $this->middleware('auth');
    }
  
    //Creamos un objeto '$request' para poderlo validar con nuestro archivo Request
    public function index(Request $request)
    {
       if($request){
           //Determinar el texto de busqueda para fltrar la categoria
           $query = trim($request->get('searchText'));
           $articulos=DB::table('articulo as a')
           ->join('categoria as c','a.idcategoria','=','c.idcategoria')
           ->select('a.idarticulo','a.nombre','a.presentacion','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
           ->where('a.nombre','LIKE','%'.$query.'%')
           ->orwhere('a.codigo','LIKE','%'.$query.'%')
           ->orwhere('c.nombre','LIKE','%'.$query.'%')
            ->orderBy('idarticulo','asc')
           
            ->paginate(7);
            
           return view ('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
       }
    }

    public function create()
    {
        $categorias = DB::table('categoria')->where('condicion','=','1')->get();
        return view("almacen.articulo.create",["categorias"=>$categorias]);
    }
    // Almacenar el objeto del modelo categoria  en nuestra tabla categoria de nuestra BD
    public function store(ArticuloFormRequest $request)
    {
        $articulo = new Articulo;
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('presentacion'); 
        $articulo->codigo=$request->get('codigo'); 
        $articulo->nombre=$request->get('nombre'); 
        $articulo->stock=$request->get('stock'); 
        $articulo->descripcion=$request->get('descripcion'); 
        $articulo->estado='Activo';

        
        if($request->hasFile('imagen')){
            $file=$request->file('imagen');
            $file->move(public_path().'/imagenes/articulos',$file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }

        $articulo->save();
        return Redirect::to('almacen\articulo');
    }
    public function show($id) 
    {
        return view("almacen.articulo.show",["articulo"=>Articulo::findorFail($id)]);
    }

    public function edit($id)
    {
        $articulo=Articulo::findOrFail($id);
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
        return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
    }

    public function update(ArticuloFormRequest $request,$id)
    {
        $articulo=Articulo::findorFail($id);
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo'); 
        $articulo->presentacion=$request->get('presentacion'); 
        $articulo->nombre=$request->get('nombre'); 
        $articulo->stock=$request->get('stock'); 
        $articulo->descripcion=$request->get('descripcion'); 
        $articulo->estado='Activo';

        if($request->hasFile('imagen')){
            $file=$request->file('imagen');
            $file->move(public_path().'/imagenes/articulos',$file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }
        // if(Input::hasFile('imagen')){
        //     $file=Input::file('imagen');
        //     $file->move(public_path(),'/imagenes/articulos',$file->getClientOriginalName());
        //     $articulo->imagen=$file->getClientOriginalName();
        // }
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }

    public function destroy($id)
    {
        $articulo=Articulo::findorFail($id);
        $articulo->estado='Inactivo';
        $articulo->update();
        //Redirige al index 
        return Redirect::to('almacen/articulo');

    }
}
