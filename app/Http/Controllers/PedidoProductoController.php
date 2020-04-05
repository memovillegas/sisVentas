<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\support\Facades\Input;
use App\Http\Requests\PedidoProductoFormRequest;
use App\PedidoProducto;
use App\DetallePedidoProducto;
use DB;

// Carbon para uso de fecha y hora de nuestra zona horaria;
use Carbon\Carbon;  
use Response;
use Illuminate\Support\Collection;

class PedidoProductoController extends Controller
{
    public function __construct(){
        // $this->middleware('auth');
   }
    public function index(Request $request)
    {
       if($request){
         $query = trim($request->get('searchText'));
         $pedidos=DB::table('pedidoproducto as pp')
         ->join('proveedores as p','pp.idProveedor','=','p.idProveedor')
         ->join('detallepedidoproducto as dpp','pp.idPedidoProducto','=','dpp.idPedidoProducto')
         ->select('pp.idPedidoProducto','pp.fechaHora','p.nombre','pp.estatus',DB::raw('sum(dpp.cantidad*precioCompra) as total'))
         ->where('p.nombre','LIKE','%'.$query.'%')
         ->orwhere('pp.fechaHora','LIKE','%'.$query.'%')
         ->orderBy('pp.idPedidoProducto','desc')
         ->groupBy('pp.idPedidoProducto','pp.fechaHora','p.nombre','pp.estatus')
         ->paginate(7);
         return view('compras.pedidos.index',["pedidos"=>$pedidos,"searchText"=>$query]);
        }
    }
    public function create()
    {
     $proveedores=DB::table('proveedores')->where('activo','=','1')->get();
     $productos = DB::table('producto as pro')
            ->select(DB::raw('CONCAT(pro.nombre, " - ",pro.codigo) AS producto'),'pro.idProducto')
            ->where('pro.estatus','=','Activo')
            ->get();
        return view("compras.pedidos.create",["proveedores"=>$proveedores,"producto"=>$productos]);
    }

    public function store(PedidoProductoFormRequest $request)
    {
     try{
         DB::beginTransaction();
         $pedidoProducto=new PedidoProducto;
         $pedidoProducto->idProveedor=$request->get('idProveedor');
        //  $ingreso->totalPagar=$request->get('totalPagar');
        //  $ingreso->saldoPendiente=$request->get('saldoPendiente');
         $mytime = Carbon::now('America/Mexico_City');
         //toDateTimeString convertir a un formato de fecha y hora para almacenarlo en el modelo y la tabla ingreso
         $pedidoProducto->fechaHora=$mytime->toDateTimeString();
         $pedidoProducto->estatus='Activo';
         $pedidoProducto->save();

         $idProducto = $request->get('idProducto');
         $cantidad = $request->get('cantidad');
         $precioCompra = $request->get('precioCompra');
         $precioVenta = $request->get('precioVenta');

         $cont = 0;

         while($cont < count($idProducto)){
             $detalle = new DetallePedidoProducto();
             $detalle->idPedidoProducto= $pedidoProducto->idPedidoProducto; 
             $detalle->idProducto= $idProducto[$cont];
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

        return Redirect::to('compras/pedidos');
    }

    public function show($id)
    {
            $pedidoProducto=DB::table('pedidoproducto as pp')
            ->join('proveedores as p','pp.idProveedor','=','p.idProveedor')
            ->join('detallepedidoproducto as dpp','pp.idPedidoProducto','=','dpp.idPedidoProducto')
            ->select('pp.idPedidoProducto','pp.fechaHora','p.nombre','pp.estatus',DB::raw('sum(dpp.cantidad*precioCompra) as total'))
            ->where('pp.idPedidoProducto','=',$id)
            ->groupBy('pp.idPedidoProducto', 'pp.fechaHora', 'p.nombre','pp.estatus')
            //mostrar el primer ingreso buscado
            ->first();

        $detalles=DB::table('detallepedidoproducto as dpp')
             ->join('producto as pro', 'dpp.idProducto','=','pro.idProducto')
             ->select('pro.nombre as producto','dpp.cantidad','dpp.precioCompra','dpp.precioVenta')
             ->where('dpp.idPedidoProducto','=',$id)
             ->get();
        return view("compras.pedidos.show",["pedidoProducto"=>$pedidoProducto,"detalles"=>$detalles]);
    }

    public function destroy($id)
    {
        $pedidoProducto=PedidoProducto::findOrFail($id);
        $ingreso->estatus='Cancelado';
        $ingreso->update();
        return Redirect::to('compras/pedidos');
    }
}
