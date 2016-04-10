<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 21/03/15
 * Time: 16:30
 */

use Shelter\Repositories\RepoServicio;
use Shelter\Managers\ServicioManager;

class ServicioController extends BaseController {

    protected $view;
    protected $repoServicio;
    protected $ruta_index;

    public function __construct(RepoServicio $repoServicio)
    {
        $this->repoServicio = $repoServicio;
        $this->view = "servicios/";
        $this->ruta_index = route('insumo.index');

    }

    public function index()
    {

    }

    public function create()
    {
        $model = $this->repoServicio->getModel();
        $data_formulario = array('route' => 'servicio.store', 'method' => 'POST', 'id' => 'frmServicio');
        $action = "Agregar";
        $ruta_index = $this->ruta_index;
        return View::make($this->view."formulario",compact("model","data_formulario","action","ruta_index"));

    }

    public function validarDatos()
    {
        $model   = $this->repoServicio->nuevoServicio();
        $data    = Input::all();
        $manager = new ServicioManager($model,$data);
        return $manager->isValid();
    }

    public function store()
    {
        $model   = $this->repoServicio->nuevoServicio();
        $data    = Input::all();
        $manager = new ServicioManager($model,$data);
        $manager->save();
        return Redirect::route('insumo.index');
    }

    public function edit($id)
    {
        $model = $this->repoServicio->getModel()->find($id);
        $data_formulario = array('route' => ["servicio.actualizar",$id], 'method' => 'post', 'id' => 'frmServicio');
        $action = "Editar";
        $ruta_index = $this->ruta_index;
        return View::make($this->view."formulario",compact("model","data_formulario","action","ruta_index"));
    }

    public function actualizar($id)
    {
        $model = $this->repoServicio->find($id);
        $data = Input::all();
        $manager = new ServicioManager($model,$data);
        $manager->save();
        return Redirect::route('insumo.index');

    }
} 