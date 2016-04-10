<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 21/03/15
 * Time: 16:26
 */
use Shelter\Repositories\RepoProducto;
use Shelter\Repositories\RepoServicio;
use Shelter\Repositories\RepoUser;
use Shelter\Repositories\RepoVenta;

class InsumoController extends BaseController
{
    protected $view;
    protected $repoProducto;
    protected $repoServicio;
    protected $repoUser;
    protected $id_negocio;
    protected $repoVenta;

    public function __construct(RepoProducto $repoProducto,RepoServicio $repoServicio,RepoUser $repoUser, RepoVenta $repoVenta)
    {
        $this->view = "insumos/";
        $this->repoProducto = $repoProducto;
        $this->repoServicio = $repoServicio;
        $this->repoUser = $repoUser;
        $this->id_negocio = $this->repoUser->negocioActual()[0]->id_negocio;
        $this->repoVenta = $repoVenta;
    }

    public function index()
    {
        $productos = $this->repoProducto->darProductosPorNegocio($this->id_negocio);
        $servicios = $this->repoServicio->darServiciosPorNegocio($this->id_negocio);
        $ventas = $this->repoVenta->darVentasPorNegocio($this->id_negocio);
//        dd($ventas);
        return View::make($this->view."listado",compact("productos","servicios","ventas"));
    }


} 