<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 04/04/15
 * Time: 19:11
 */

use Shelter\Managers\VentaManager;
use Shelter\Repositories\RepoVenta;
use Shelter\Entities\Venta;
use Shelter\Repositories\RepoGrupo;
use Shelter\Repositories\RepoUser;
use Shelter\Repositories\RepoProducto;
use Shelter\Repositories\RepoProductoXStock;

class VentaController extends BaseController {

    protected $repoVenta;
    protected $repoGrupo;
    protected $repoProducto;
    protected $repoProductoxStock;
    protected $view;
    protected $ruta;
    protected $id_negocio_actual;
    protected $repoUser;
    protected $ruta_index;


    public function __construct(RepoVenta $repoVenta,
                                RepoGrupo $repoGrupo,
                                RepoUser $repoUser,
                                RepoProducto $repoProducto,
                                RepoProductoXStock $repoProductoXStock){
        $this->repoVenta = $repoVenta;
        $this->repoGrupo = $repoGrupo;
        $this->repoProducto = $repoProducto;
        $this->repoProductoxStock = $repoProductoXStock;
        $this->repoUser = $repoUser;

        $this->view = "ventas/";
        $this->ruta = "venta.";
        $this->ruta_index = route('insumo.index');
        $this->id_negocio_actual = $this->repoUser->negocioActual()[0]->id_negocio;

    }

    public function create()
    {
        $ventas = array();
        Session::put('ventas',$ventas);
        $venta = $this->repoVenta->getModel();
        $combo_grupos = $this->repoGrupo->getList();
        $data_formulario = array('route' => $this->ruta.'store', 'method' => 'POST', 'id' => 'frmVenta');
        $action = "Agregar";
        $ruta_index = $this->ruta_index;
        return View::make($this->view."formulario",compact("venta","data_formulario","action","combo_grupos","ruta_index"));
    }

    public function search()
    {
        $producto = $_POST['nombre'];
        $seleccionados = $this->darIdProductosCargados();
        $productos = $this->repoProducto->darProductosPorDescripcion($producto,$this->id_negocio_actual,$seleccionados);

        return View::make($this->view."productosEncontrados",compact("productos"));

    }

    private function darIdProductosCargados()
    {
        $ventas = Session::get("ventas");
        $seleccionados = "";
        if(count($ventas) > 0)
        {
            $seleccionados = "";
            foreach($ventas as $v)
            {
                if($seleccionados == "")
                    $seleccionados .= $v->id_producto;
                else
                    $seleccionados .= ",".$v->id_producto;

            }
            $seleccionados .= "";
        }
        return $seleccionados;
    }

    public function productoSeleccionado()
    {
        $nombre = $_POST['nombre'];
        $producto_seleccionado = $this->repoProducto->darProductoPorDescripcion($nombre);
        if($producto_seleccionado)
            $disponibilidad = $this->repoProductoxStock->darStockTotal($producto_seleccionado->id);
        else
            $disponibilidad = "No encontrado";
        return $disponibilidad;
//        return View::make($this->view."productoSeleccionado",compact("id","producto","disponibilidad","precio_actual"));
    }

    public function productoConfirmado()
    {
        return HelperVenta::agregarVenta();
    }

    public function darListaProductoAutocompletar()
    {
        $producto = $_GET['term'];
        $seleccionados = $this->darIdProductosCargados();
        $lista = $this->repoProducto->darProductosPorDescripcion($producto,$this->id_negocio_actual,$seleccionados);
        return $lista;
    }

    public function productoCorrecto()
    {
        $nombre = $_POST['nombre'];
        $producto_seleccionado = $this->repoProducto->darProductoPorDescripcion($nombre);
        return $producto_seleccionado->nombre;

    }

    public function eliminarProducto()
    {
        return HelperVenta::eliminarVenta();
    }

    public function validarDatos()
    {
        $model   = $this->repoVenta->nuevaVenta();
        $data    = Input::all();
        $manager = new VentaManager($model,$data);
        return $manager->isValid();
    }

    public function store()
    {
        $lista = Session::get("ventas");
        $id = $this->repoVenta->darUltimoId();
        foreach($lista as $l)
        {
            $model = $this->repoVenta->nuevaVenta();
            $l->id = $id;
            $l->id_grupo = $_POST['id_grupo'];
            $l->id_negocio = $this->id_negocio_actual;
            $l->eliminado = 0;
            $data = $this->darDataVenta($l);
            $manager = new VentaManager($model,$data);
            $manager->save();
            $this->repoProductoxStock->actualizarStock($l->producto->id,$l->cantidad);
        }
        return Redirect::route('insumo.index');
    }

    private function darDataVenta($venta)
    {
        $data = array();
        $data['id'] = $venta->id;
        $data['id_grupo'] = $venta->id_grupo;
        $data['id_negocio'] = $venta->id_negocio;
        $data['eliminado'] = $venta->eliminado;
        $data['nro_registro'] = $venta->nro_registro;
        $data['id_producto'] = $venta->id_producto;
        $data['cantidad'] = $venta->cantidad;
        $data['precio_unitario'] = $venta->precio_unitario;
        return $data;

    }

    public function verDetalle($id)
    {
        $venta = $this->repoVenta->darVenta($id);
        $combo_grupos = $this->repoGrupo->getList();
        $mensaje = "¿Confirma que desea anular la venta?";
        $precio_total = HelperVenta::darPrecioTotal($venta);
        $lista_productos = HelperVenta::listadoVentas($venta,$precio_total,"NoMostrar");
        return View::make($this->view."verDetalle",compact("venta","combo_grupos","grupo_seleccionado","lista_productos","mensaje"));
    }

    public function anular()
    {
        $id = $_POST['id'];
        $venta = $this->repoVenta->darVenta($id);
        $this->repoVenta->anularVenta($id);
        foreach($venta as $v)
            $this->repoProductoxStock->devolucionStock($v->id_producto,$v->cantidad);



        return "Ok";

    }


} 