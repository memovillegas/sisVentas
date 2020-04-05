<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\support\Facades\Input;
use App\Http\Requests\IngresoFormRequest;
use App\Ingreso;
use App\DetalleIngreso;
use DB;

// Carbon para uso de fecha y hora de nuestra zona horaria;
use Carbon\Carbon;  
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller
{
    public function __construct(){
        // $this->middleware('auth');
   }
    public function index(Request $request)
    {
       if($request){
         $query = trim($request->get('searchText'));
         $ingresos=DB::table('ingreso as i')
         ->join('proveedor as p','i.idProveedor','=','p.idProveedor')
         ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
         ->select('i.idingreso','i.fecha_hora','p.nombre','i.numComprobante','i.estatus',DB::raw('sum(di.cantidad*precioCompra) as total'))
         ->where('i.numComprobante','LIKE','%'.$query.'%')
         ->orderBy('i.idingreso','desc')
         ->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.numComprobante','i.estatus')
         ->paginate(7);
         return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
        }
    }
    public function create()
    {
     $proveedores=DB::table('proveedor')->where('activo','=','1')->get();
     $articulos = DB::table('articulo as art')
            ->select(DB::raw('CONCAT(art.nombre, " - ",art.codigo) AS articulo'),'art.idarticulo')
            ->where('art.estado','=','Activo')
            ->get();
        return view("compras.ingreso.create",["proveedores"=>$proveedores,"articulos"=>$articulos]);
    }

    public function store(IngresoFormRequest $request)
    {
     try{
         DB::beginTransaction();
         $ingreso=new Ingreso;
         $ingreso->idProveedor=$request->get('idProveedor');
         $ingreso->numComprobante=$request->get('numComprobante');
        //  $ingreso->totalPagar=$request->get('totalPagar');
        //  $ingreso->saldoPendiente=$request->get('saldoPendiente');
         $mytime = Carbon::now('America/Mexico_City');
         //toDateTimeString convertir a un formato de fecha y hora para almacenarlo en el modelo y la tabla ingreso
         $ingreso->fecha_hora=$mytime->toDateTimeString();
         $ingreso->estatus='Activo';
         $ingreso->save();

         $idarticulo = $request->get('idarticulo');
         $cantidad = $request->get('cantidad');
         $precioCompra = $request->get('precioCompra');
         $precioVenta = $request->get('precioVenta');

         $cont = 0;

         while($cont < count($idarticulo)){
             $detalle = new DetalleIngreso();
             $detalle->idingreso= $ingreso->idingreso; 
             $detalle->idarticulo= $idarticulo[$cont];
             $detalle->cantidad= $cantidad[$cont];
             $detalle->precioCompra= $precioCompra[$cont];
             $detalle->precioVenta= $precioVenta[$cont];
             $detalle->save();
             $cont=$cont+1;            
         }

         DB::commit();

        }catch(\Exception $e)
        {
            //Rollback anular la transaccion
           DB::rollback();
        }

        return Redirect::to('compras/ingreso');
    }

    public function show($id)
    {
            $ingreso=DB::table('ingreso as i')
            ->join('proveedor as p','i.idProveedor','=','p.idProveedor')
            ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
            ->select('i.idingreso','i.fecha_hora','p.nombre','i.numComprobante','i.estatus',DB::raw('sum(di.cantidad*precioCompra) as total'))
            ->where('i.idingreso','=',$id)
            ->groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.numComprobante','i.estatus')
            //mostrar el primer ingreso buscado
            ->first();

        $detalles=DB::table('detalle_ingreso as d')
             ->join('articulo as a', 'd.idarticulo','=','a.idarticulo')
             ->select('a.nombre as articulo','d.cantidad','d.precioCompra','d.precioVenta')
             ->where('d.idingreso','=',$id)
             ->get();
        return view("compras.ingreso.show",["ingreso"=>$ingreso,"detalles"=>$detalles]);
    }

    public function destroy($id)
    {
        $ingreso=Ingreso::findOrFail($id);
        $ingreso->Estado='Cancelado';
        $ingreso->update();
        return Redirect::to('compras/ingreso');
    }
}
