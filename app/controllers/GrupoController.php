<?php

use Shelter\Managers\GrupoXNegocioManager;
use Shelter\Repositories\RepoEstilos;
use Shelter\Repositories\RepoUsuarioXNegocio;
use Shelter\Repositories\RepoGruposXNegocios;
use Shelter\Repositories\RepoGrupo;
use Shelter\Repositories\RepoContacto;
use Shelter\Repositories\RepoUser;
use Shelter\Managers\GrupoManager;

class GrupoController extends BaseController {

    protected $repoEstilos;
    protected $repoUsuarioXNegocio;
    protected $repoGrupoXNegocio;
    protected $repoGrupo;
    protected $repoContacto;
    protected $repoUser;
    protected $view;
    protected $id_negocio_principal;
    protected $ruta_index;

    public function __construct(RepoGrupo $repoGrupo,
                                RepoContacto $repoContacto,
                                RepoGruposXNegocios $repoGrupoXNegocio,
                                RepoUsuarioXNegocio $repoUsuarioXNegocio,
                                RepoUser $repoUser,
                                RepoEstilos $repoEstilos){
        $this->repoGrupo = $repoGrupo;
        $this->repoContacto = $repoContacto;
        $this->repoEstilos = $repoEstilos;
        $this->repoUsuarioXNegocio = $repoUsuarioXNegocio;
        $this->repoGrupoXNegocio = $repoGrupoXNegocio;
        $this->repoUser = $repoUser;
        $this->view = "grupos/";
        $this->ruta_index = route('grupo.index');
        if(count($this->repoUser->negocioActual())>0)
            $this->id_negocio_principal = $this->repoUser->negocioActual()[0]->id_negocio;
        else
            $this->id_negocio_principal = "";
    }

    function index()
    {
        $contactos = array();
        Session::put('contactos',$contactos);
        $grupos = $this->repoGrupoXNegocio->listado();
        if(Auth::user()->tipo_usuario == 1)
            return View::make($this->view."listadoAdministrador", compact('grupos'));
        else
            return View::make($this->view."listado", compact('grupos'));
    }

    public function nuevoGrupo()
    {
        $ruta_index = $this->ruta_index;
        $action = "Buscar";
        return View::make($this->view."nuevoGrupo",compact("ruta_index","action"));
    }

    public function darListaGruposAutocompletar()
    {
        $nombre = $_GET['term'];
        $lista = $this->repoGrupo->buscarGruposPorNombre($nombre);
        return $lista;

    }

    public function analizarGrupo()
    {
        $nombre = $_POST['nombre'];
        $model = $this->repoGrupo->buscarGrupoPorNombre($nombre);
        if($model)
        {
            $lista_contactos = Session::get("contactos");
            $lista_contactos = unserialize(serialize($lista_contactos));

            if(count($lista_contactos) == 0)
            {
                Session::put('contactos',$lista_contactos);
            }
            $nombre = $model->nombre;
//            dd($grupo);
            if(($model->id_usuario_creador == Auth::user()->id) || (Auth::user()->tipo_usuario == 1))
            {
                $id_negocio = $this->id_negocio_principal;
                $permitir_modificar = true;
            }
            else
            {
                $id_negocio = $this->id_negocio_principal;
                $permitir_modificar = false;
            }
            $combo_estilos = $this->repoEstilos->combos("estilo","id");
            $contactos = HelperContacto::listadoContactos($lista_contactos,$permitir_modificar);
            $data_formulario = array('route' => 'grupo.actualizar', 'method' => 'POST', 'id' => 'frmGrupo');
            $action    = 'Importar';
            $ruta_index = $this->ruta_index;

            return View::make($this->view."formulario",compact("model","combo_estilos","data_formulario","action","id_negocio","contactos","nombre","permitir_modificar","ruta_index"));
        }
        else
            return $this->create($nombre);
    }

    function create($nombre)
    {
        $model = $this->repoGrupo->getModel();
        $model->nombre = $nombre;
        $combo_estilos = $this->repoEstilos->combos("estilo","id");
        if(($model->id_usuario_creador == Auth::user()->id) || (Auth::user()->tipo_usuario == 1))
        {
            $id_negocio = "";
            $permitir_modificar = true;
        }
        else
        {
            $id_negocio = $this->id_negocio_principal;
            $permitir_modificar = false;
        }
//        $permitir_modificar = true;
        $contactos = "";
        $data_formulario = array('route' => 'grupo.store', 'method' => 'POST', 'id' => 'frmGrupo');
        $action    = 'Agregar';
        $ruta_index = $this->ruta_index;
//        dd($nombre);
        return View::make($this->view."formulario",compact("model","combo_estilos","data_formulario","action","id_negocio","contactos","nombre","permitir_modificar","ruta_index"));
    }

    public function agregarContacto()
    {
        return HelperContacto::agregarContacto();
    }

    public function validarDatos()
    {
        $model   = $this->repoGrupo->nuevoGrupo();
        $data    = Input::all();
        $manager = new GrupoManager($model,$data);
        return $manager->isValid();

    }

    function store()
    {
        $model   = $this->repoGrupo->nuevoGrupo();
        $data    = Input::all();
        $data['id_usuario_creador'] = Auth::user()->id;
        $manager = new GrupoManager($model,$data);
        $manager->save();
        if(Auth::user()->tipo_usuario != 1)
        {
            $datos = array();
            $model = $this->repoGrupoXNegocio->getModel();
            $datos['id_negocio'] = $this->id_negocio_principal;
            $datos['id_grupo'] = $manager->getEntity()->id;
            $grupoxnegocio = new GrupoXNegocioManager($model,$datos);
            $grupoxnegocio->save();

            $lista_contactos = Session::get("contactos");
            $lista_contactos = unserialize(serialize($lista_contactos));
            $reg_principal = $data['principal'];
            foreach($lista_contactos as $contacto)
            {
                if($contacto->nro_integrante == $reg_principal)
                    $principal = 1;
                else
                    $principal = 0;

                if(Auth::user()->tipo_usuario == 2)
                    $this->repoContacto->guardar($manager->getEntity()->id, $contacto->nro_integrante, $contacto->nombrecontacto, $contacto->telefonocontacto, $principal,Auth::user()->negocioActual()[0]->id_negocio);
            }

        }


        return Redirect::route('grupo.index');
    }

    function edit($valores)
    {
//        dd($valores);
        $valores = explode("-",$valores);
        $id = $valores[0];
        $lista_contactos = Session::get("contactos");
        $lista_contactos = unserialize(serialize($lista_contactos));


        $model = $this->repoGrupo->find($id);
        $nombre = $model->nombre;
        $data_formulario = array('route' => 'grupo.actualizar', 'method' => 'POST', 'id' => 'frmGrupo');
        $action    = 'Editar';
        $ruta_index = $this->ruta_index;
//        if(($model->id_usuario_creador != Auth::user()->id) || (Auth::user()->tipo_usuario == 1))
//        {
//            $id_negocio = $valores[1];
//            $permitir_modificar = true;
//            $lista_contactos = array();
//        }
//        else
//        {
            $id_negocio = $valores[1];
            $permitir_modificar = false;
            if(count($lista_contactos) == 0)
            {
                $lista_contactos = $this->repoContacto->listadoPorGrupo($id,$id_negocio);
                Session::put('contactos',$lista_contactos);
            }
//            dd($lista_contactos);
//        }
        $combo_estilos = $this->repoEstilos->combos("estilo","id");
        $contactos = HelperContacto::listadoContactos($lista_contactos,$permitir_modificar);

        return View::make($this->view."formulario",compact("model","combo_estilos","data_formulario","action","id_negocio","contactos","nombre","permitir_modificar","ruta_index"));
    }

    function actualizar()
    {
        $data = Input::all();
        $id = $data['id'];
        $id_negocio = $data['id_negocio'];
        $grupo = $this->repoGrupo->find($id);
        $grupo->fill($data);
        $grupo->save();

        if(Auth::user()->tipo_usuario != 1)
        {
            $this->repoContacto->eliminarContactosPorGrupo($id,$id_negocio);
            $lista_contactos = Session::get("contactos");
            $lista_contactos = unserialize(serialize($lista_contactos));
            $reg_principal = $data['principal'];
            foreach($lista_contactos as $contacto)
            {
                if($contacto->nro_integrante == $reg_principal)
                    $principal = 1;
                else
                    $principal = 0;
                $this->repoContacto->guardar($grupo->id,$contacto->nro_integrante,$contacto->nombrecontacto,$contacto->telefonocontacto,$principal,$id_negocio);
                $datos = array();
                $datos['id_negocio'] = $id_negocio;
                $datos['id_grupo'] = $grupo->id;
                if(Auth::user()->tipo_usuario != 1)
                {
                    if($this->repoGrupoXNegocio->validarGrupoXNegocio($grupo->id,$datos['id_negocio']))
                    {
                        $model = $this->repoGrupoXNegocio->getModel();
                        $grupoxnegocio = new GrupoXNegocioManager($model,$datos);
                        $grupoxnegocio->save();
                    }
                }
            }

        }

        return Redirect::route('grupo.index');
    }


    function destroy()
    {
        $id = $_POST['id'];
        $model = new RepoGrupo();
        $model->eliminarGrupo($id);
        return "Ok";
    }

    function borrarContacto()
    {
        return HelperContacto::borrarContacto();
    }

    public function show()
    {

    }


}
