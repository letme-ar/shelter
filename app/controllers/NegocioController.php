<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 11/12/14
 * Time: 13:33
 */
use Shelter\Managers\NegocioManager;
use Shelter\Repositories\RepoNegocios;
use Shelter\Repositories\RepoTelefono;
use Shelter\Repositories\RepoSala;
use Shelter\Repositories\RepoProvincias;
use Shelter\Repositories\RepoLocalidades;
use Shelter\Repositories\RepoUsuarioXNegocio;
use Shelter\Repositories\RepoUser;

class NegocioController extends BaseController {

    protected $repoNegocio;
    protected $repoTelefono;
    protected $repoSala;
    protected $repoProvincias;
    protected $repoLocalidades;
    protected $repoUsuarioXNegocio;
    protected $repoUser;
    protected $view;
    protected $ruta_index;

    public function __construct(RepoNegocios $repoNegocio,RepoTelefono $repoTelefono,RepoSala $repoSala,RepoProvincias $repoProvincias,RepoLocalidades $repoLocalidades,RepoUsuarioXNegocio $repoUsuarioXNegocio,RepoUser $repoUser){
        $this->repoNegocio = $repoNegocio;
        $this->repoTelefono = $repoTelefono;
        $this->repoSala = $repoSala;
        $this->repoProvincias = $repoProvincias;
        $this->repoLocalidades = $repoLocalidades;
        $this->repoUsuarioXNegocio = $repoUsuarioXNegocio;
        $this->repoUser = $repoUser;
        $this->view = "negocios/";
        $this->ruta_index = route('negocio.index');
    }

    function index()
    {
        Session::put('telefonos',array());
        Session::put('salas',array());
        $negocios = $this->repoNegocio->listado();
        return View::make($this->view."listado", compact('negocios'));
    }
    function create()
    {
        $model = $this->repoNegocio;
        $data_formulario = array('route' => 'negocio.store', 'method' => 'POST', 'id' => 'frmNegocio');
        $action    = 'Agregar';
        $combo_provincias = $this->darComboProvincias();
        $combo_localidades = $this->darComboLocalidades();
        $telefonos = "";
        $salas = "";
        $usuarios_no_seleccionados = $this->repoUser->darListaUsuarios();
        $usuarios_seleccionados = array();
        $hidden_usuarios_seleccionados = "";
        $ruta_index = $this->ruta_index;

        return View::make($this->view."formulario",compact("model","data_formulario","action","combo_provincias","combo_localidades","telefonos","salas","usuarios_seleccionados","usuarios_no_seleccionados","hidden_usuarios_seleccionados","ruta_index"));
    }

    private function darComboProvincias($seleccionado = "")
    {
        $provincias = $this->repoProvincias->darListaParaCombo();
        $combo_provincias = array('' => 'Seleccione') + $provincias;
        return Form::select('id_provincia', $combo_provincias, $seleccionado, array('multiple' => 'multiple','id' => 'id_provincia'));

    }

    function darComboLocalidades($id_provincia="",$seleccionado="")
    {
        if(isset($_POST['id_provincia']))
        {
            $id_provincia = $_POST['id_provincia'];
            $localidades = $this->repoLocalidades->darListaParaCombo($id_provincia);
            $combo_localidades = array('' => 'Seleccione') + $localidades;
            return Form::select('id_localidad', $combo_localidades, $seleccionado, array('multiple' => 'multiple','id' => 'id_localidad')).'<script>$("#id_localidad").multipleSelect({
                single: true,
                filter: true
            });</script>';
        }
        else
        {
            $localidades = $this->repoLocalidades->darListaParaCombo($id_provincia);
            return Form::select('id_localidad', $localidades, $seleccionado, array('multiple' => 'multiple','id' => 'id_localidad')).'<script>$("#id_localidad").multipleSelect({
                single: true,
                filter: true
            });</script>';
        }

    }

    public function agregarTelefono(){ return HelperTelefono::agregarTelefono(); }

    function borrarTelefono(){ return HelperTelefono::borrarTelefono(); }

    public function agregarSala(){ return HelperSala::agregarSala(); }

    function borrarSala(){ return HelperSala::borrarSala(); }


    public function validarDatos()
    {
        $model   = $this->repoNegocio->nuevoNegocio();
        $data    = Input::all();
        $manager = new NegocioManager($model,$data);
        return $manager->isValid();
    }

    private function darArrayUsuarios($lista)
    {
        if($lista)
        {
            $array = explode(",",$lista);
            return $array;
        }
    }

    function store()
    {
        $model   = $this->repoNegocio->nuevoNegocio();
        $data    = Input::all();
        $manager = new NegocioManager($model,$data);
        $manager->save();

        $lista_telefonos = Session::get("telefonos");
        $this->repoTelefono->guardar($manager->getEntity()->id, $lista_telefonos,$data['principal_telefono']);

        $lista_salas = Session::get("salas");
        $this->repoSala->guardar($manager->getEntity()->id, $lista_salas,$data['principal_sala']);

        $usuarios_seleccionados = $this->darArrayUsuarios($data['usuarios_seleccionados']);
        $this->repoUsuarioXNegocio->guardarListaUsuarios($manager->getEntity()->id,$usuarios_seleccionados);

        return Redirect::route('negocio.index');
    }

    private function darHiddenUsuariosSeleccionados($usuarios_seleccionados)
    {
        $string = "";
        foreach($usuarios_seleccionados as $usuario)
        {
            if($string == "")
                $string .= $usuario->id;
            else
                $string .= ",".$usuario->id;
        }
        return $string;
    }

    public function edit($id)
    {
        $model = $this->repoNegocio->find($id);
        $lista_telefonos = Session::get("telefonos");
        $lista_telefonos = unserialize(serialize($lista_telefonos));
        $lista_salas = Session::get("salas");
        $lista_salas = unserialize(serialize($lista_salas));

        if(count($lista_telefonos) == 0)
        {
            $lista_telefonos = $this->repoTelefono->listadoPorNegocio($model->id);
            Session::put('telefonos',$lista_telefonos);
        }

        if(count($lista_salas) == 0)
        {
            $lista_salas = $this->repoSala->listadoPorNegocio($model->id);
            Session::put('salas',$lista_salas);
        }
        $id_provincia = $this->repoLocalidades->getById($model->id_localidad)->id_provincia;
        $data_formulario = array('route' => 'negocio.actualizar', 'method' => 'POST', 'id' => 'frmNegocio');
        $action    = 'Editar';
        $telefonos = HelperTelefono::listadoTelefonos($lista_telefonos);
        $salas = HelperSala::listadoSalas($lista_salas);

        $usuarios_no_seleccionados = $this->repoUser->darListaUsuarios($id);
        $usuarios_seleccionados = $this->repoUsuarioXNegocio->darUsuariosSeleccionadosPorNegocio($id);
        $hidden_usuarios_seleccionados = $this->darHiddenUsuariosSeleccionados($usuarios_seleccionados);

        $combo_provincias = $this->darComboProvincias($id_provincia);
        $combo_localidades = $this->darComboLocalidades($id_provincia,$model->id_localidad);
        $ruta_index = $this->ruta_index;
        return View::make($this->view."formulario",compact("model","data_formulario","action","combo_provincias","combo_localidades","telefonos","salas","usuarios_seleccionados","usuarios_no_seleccionados","hidden_usuarios_seleccionados","ruta_index"));

    }

    public function actualizar()
    {

        $data = Input::all();
        $id = $data['id'];
        $model   = $this->repoNegocio->find($id);
        $manager = new NegocioManager($model,$data);
        $manager->save();


        $this->repoTelefono->eliminarTelefonoPorNegocio($id);
        $this->repoSala->eliminarSalaPorNegocio($id);

        $lista_telefonos = Session::get("telefonos");
        $this->repoTelefono->guardar($manager->getEntity()->id, $lista_telefonos,$data['principal_telefono']);

        $lista_salas = Session::get("salas");
        $this->repoSala->guardar($manager->getEntity()->id, $lista_salas,$data['principal_sala']);

        $this->repoUsuarioXNegocio->eliminarUsuariosPorNegocio($id);
        $usuarios_seleccionados = $this->darArrayUsuarios($data['usuarios_seleccionados']);
        $this->repoUsuarioXNegocio->guardarListaUsuarios($id,$usuarios_seleccionados);

        return Redirect::route('negocio.index');
    }

    function desactivar()
    {
        $id = $_POST['id'];
        $estado = $_POST['estado'];
        $this->repoNegocio = $this->repoNegocio->find($id);
        $this->repoNegocio->cambiarEstado($id,$estado);
        return "Ok";
    }



}