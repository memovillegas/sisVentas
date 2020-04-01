<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaFormRequest;
use DB;
class CategoriaController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
   }
    public function index(Request $request)
    {
       if($request){
           //Determinar el texto de busqueda para fltrar la categoria
           $query = trim($request->get('searchText'));
           $categorias=DB::table('categoria')
           ->where('nombre','LIKE','%'.$query.'%')
           ->where('condicion','=','1')
            ->orderBy('idcategoria','asc')
            ->paginate(7);
           return view ('almacen.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
       }
    }

    public function create()
    {
        return view("almacen.categoria.create");
    }
    // Almacenar el objeto del modelo categoria  en nuestra tabla categoria de nuestra BD
    public function store(CategoriaFormRequest $request)
    {
        $categoria = new Categoria;
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->condicion='1';
        $categoria->save();
        return Redirect::to('almacen\categoria');
    }
    public function show($id) 
    {
        return view("almacen.categoria.show",["categoria"=>Categoria::findorFail($id)]);
    }

    public function edit($id)
    {
        return view("almacen.categoria.edit",["categoria"=>Categoria::findorFail($id)]);
    }

    public function update(CategoriaFormRequest $request,$id)
    {
        $categoria=Categoria::findorFail($id);
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->update();
        return Redirect::to('almacen/categoria');
        // $categoria=Categoria::findOrFail($id);
        // $categoria->nombre=$request->get('nombre');
        // $categoria->descripcion=$request->get('descripcion');
        // $categoria->update();
        // return view Redirect::to('almacen/categoria');
    }

    public function destroy($id)
    {
        $categoria=Categoria::findorFail($id);
        $categoria->condicion='0';
        $categoria->update();
        //Redirige al index 
        return Redirect::to('almacen/categoria');

    }
}
