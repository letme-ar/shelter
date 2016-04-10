<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 21/03/15
 * Time: 16:29
 */
use Shelter\Repositories\RepoProducto;
use Shelter\Repositories\RepoProductoXStock;
use Shelter\Managers\ProductoManager;
use Shelter\Managers\ProductoXStockManager;
use Shelter\Repositories\RepoVenta;

class ProductoController extends BaseController{

    var $repoProducto;
    var $repoProductoXStock;
    var $view;
    private $repoVenta;
    protected $ruta_index;

    public function __construct(RepoProducto $repoProducto,RepoProductoXStock $repoProductoXStock, RepoVenta $repoVenta)
    {
        $this->repoProducto = $repoProducto;
        $this->repoProductoXStock = $repoProductoXStock;
        $this->view = "productos/";
        $this->repoVenta = $repoVenta;
        $this->ruta_index = route('insumo.index');
    }

    public function index()
    {

    }

    public function create()
    {
        $model = $this->repoProducto->getModel();
        $data_formulario = array('route' => 'producto.store', 'method' => 'POST', 'id' => 'frmProducto');
        $action = "Agregar";
        $ruta_index = $this->ruta_index;
        return View::make("productos/formulario",compact("model","data_formulario","action","ruta_index"));

    }

    public function validarDatos()
    {
        $model   = $this->repoProducto->nuevoProducto();
        $data    = Input::all();
        $manager = new ProductoManager($model,$data);
        return $manager->isValid();
    }

    public function store()
    {
        $model   = $this->repoProducto->nuevoProducto();
        $data    = Input::all();
        $manager = new ProductoManager($model,$data);
        $manager->save();
        return Redirect::route('insumo.index');
    }

    public function agregarStock($id)
    {
        $model = $this->repoProductoXStock->darUltimoAgregado($id);
        $producto = $this->repoProducto->find($id);
        $stock_total = $this->repoProductoXStock->darStockTotal($id);
        $cantidad_vendida = $this->repoVenta->darCantidadVendidaDeUnProducto($id);

        $productoxstock = $this->repoProductoXStock->darRegistrosXId($id);

        $ruta_index = $this->ruta_index;
        $action = "Actualizar";
        $data_formulario = array('route' => ['producto.actualizarStock',$id], 'method' => 'POST', 'id' => 'frmProducto');
        return View::make("productos/stock",compact("model","data_formulario","productoxstock","producto","stock_total","cantidad_vendida","ruta_index","action"));

    }

    public function actualizarStock($id)
    {
        $model   = $this->repoProductoXStock->nuevoProductoXStock();
        $data    = Input::all();
        $manager = new ProductoXStockManager($model,$data);
//        dd($manager);
        $manager->save($id);
        return Redirect::route('insumo.index');
    }

    public function edit($id)
    {
        $model = $this->repoProducto->find($id);
        $data_formulario = array('route' => ['producto.actualizar',$id], 'method' => 'POST', 'id' => 'frmProducto');
        $ruta_index = $this->ruta_index;
        $action = "Editar";
        return View::make("productos/editarProducto",compact("model","data_formulario","ruta_index","action"));
    }

    public function actualizar($id)
    {
        $model   = $this->repoProducto->find($id);
        $data    = Input::all();
        $manager = new ProductoManager($model,$data);
        $manager->save();
        return Redirect::route('insumo.index');

    }

} 