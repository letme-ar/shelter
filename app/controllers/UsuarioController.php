<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 16/12/14
 * Time: 15:19
 */
use Shelter\Repositories\RepoUser;
use Shelter\Repositories\RepoNegocios;
use Shelter\Repositories\RepoTipoUsuario;
use Shelter\Repositories\RepoUsuarioXNegocio;
use Shelter\Managers\UserManager;
class UsuarioController extends BaseController
{
    protected $view;
    protected $repoUser;
    protected $repoNegocio;
    protected $repoTipoUsuario;
    protected $repoUsuarioXNegocio;
    protected $ruta_index;
    public function __construct(RepoUser $repoUser,
                                RepoNegocios $repoNegocios,
                                RepoTipoUsuario $repoTipoUsuario,
                                RepoUsuarioXNegocio $repoUsuarioXNegocio)
    {
        $this->repoUser = $repoUser;
        $this->repoNegocio = $repoNegocios;
        $this->repoTipoUsuario = $repoTipoUsuario;
        $this->repoUsuarioXNegocio = $repoUsuarioXNegocio;
        $this->view = "usuarios/";
        $this->ruta_index = route('usuario.index');
    }


    function index()
    {
        $usuarios = $this->repoUser->listado();
        return View::make($this->view."listado", compact('usuarios'));
    }

    public function create()
    {
        $model = $this->repoUser->getModel();
        $data_formulario = array('route' => 'usuario.store', 'method' => 'POST', 'id' => 'frmUser');
        $action    = 'Agregar';
        $combo_tipos_usuarios = $this->darComboTiposUsuarios();
        $negocios_no_seleccionados = $this->repoNegocio->darListaNegocios();
        $negocios_seleccionados = array();
        $hidden_negocios_seleccionados = "";
        $ruta_index = $this->ruta_index;
        return View::make($this->view."formulario",
            compact(
                "model",
                "data_formulario",
                "action",
                "ruta_index",
                "combo_tipos_usuarios",
                "negocios_no_seleccionados",
                "negocios_seleccionados",
                "hidden_negocios_seleccionados"
            ));
    }

    private function darComboTiposUsuarios($seleccionado = "")
    {
        return $this->repoTipoUsuario->darListaParaCombo();
    }

    public function validarDatos()
    {
        $model   = $this->repoUser->nuevoUser();
        $data    = Input::all();
        $manager = new UserManager($model,$data);
        return $manager->isValid();
    }

    private function darArrayNegocios($lista)
    {
        if($lista)
        {
            $array = explode(",",$lista);
            return $array;
        }
    }

    public function store()
    {
        $model   = $this->repoUser->nuevoUser();
        $data    = Input::all();
        $data['password']= Hash::make("123456");
        $manager = new UserManager($model,$data);
        $manager->save();

        $negocios_seleccionados = $this->darArrayNegocios($data['negocios_seleccionados']);
        $this->repoUsuarioXNegocio->guardarListaNegocios($manager->getEntity()->id,$negocios_seleccionados);
        return Redirect::route('usuario.index');
    }

    public function cambiarEstado()
    {
        $id = $_POST['id'];
        $estado = $_POST['estado'];
        $model = new RepoUser();
        $model->cambiarEstado($id,$estado);
        return "Ok";
    }

    public function reiniciarPassword()
    {
        $id = $_POST['id'];
        $model = new RepoUser();
        $model->reiniciarPassword($id);
        return "Ok";

    }

    private function darHiddenNegociosSeleccionados($negocios_seleccionados)
    {
        $string = "";
        foreach($negocios_seleccionados as $negocio)
        {
            if($string == "")
                $string .= $negocio->id;
            else
                $string .= ",".$negocio->id;
        }
        return $string;
    }

    public function edit($id)
    {
        $model = $this->repoUser->find($id);
        $data_formulario = array('route' => 'usuario.actualizar', 'method' => 'POST', 'id' => 'frmUser');
        $action    = 'Modificar';
        $ruta_index = $this->ruta_index;
        $combo_tipos_usuarios = $this->darComboTiposUsuarios($model->tipo_usuario);
        $negocios_no_seleccionados = $this->repoNegocio->darListaNegocios($id);
        $negocios_seleccionados = $this->repoUsuarioXNegocio->darNegociosSeleccionadosPorUsuario($id);
        $hidden_negocios_seleccionados = $this->darHiddenNegociosSeleccionados($negocios_seleccionados);
        return View::make($this->view."formulario",
            compact(
                "model",
                "data_formulario",
                "action",
                "ruta_index",
                "combo_tipos_usuarios",
                "negocios_no_seleccionados",
                "negocios_seleccionados",
                "hidden_negocios_seleccionados"
            ));

    }

    public function actualizar()
    {
        $data = Input::all();
        $id = $data['id'];
        $model = $this->repoUser->find($id);
        $model->fill($data);
        $model->save();
        /*$usuario = User::find($id);

        $usuario->fill($data);
        $usuario->save();
        */
        $this->repoUsuarioXNegocio->eliminarNegociosPorUsuario($id);

        $negocios_seleccionados = $this->darArrayNegocios($data['negocios_seleccionados']);
        $this->repoUsuarioXNegocio->guardarListaNegocios($model->id,$negocios_seleccionados);
        return Redirect::route('usuario.index');
    }
}
