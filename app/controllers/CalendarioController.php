<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 04/02/15
 * Time: 15:28
 */
use Shelter\Components\FunctionsSpecials;
use Shelter\Repositories\RepoHorarios;
use Shelter\Repositories\RepoReservaEstado;
use Shelter\Repositories\RepoSala;
use Shelter\Repositories\RepoReservasSalas;
use Shelter\Repositories\RepoGrupo;
use Shelter\Repositories\RepoContacto;
use Shelter\Repositories\RepoServicio;
use Shelter\Repositories\RepoUser;
use Shelter\Managers\ReservaSalaManager;

class CalendarioController extends BaseController
{
    protected $view;
    protected $id_negocio_principal;
    protected $repoSala;
    protected $repoUser;
    protected $repoReservaSala;
    protected $repoGrupo;
    protected $repoContacto;
    private $repoReservaEstado;
    private $repoServicio;
    private $ruta_index;
    /**
     * @var RepoHorarios
     */
    private $repoHorarios;
    /**
     * @var FunctionsSpecials
     */
    private $functionsSpecials;

    public function __construct(RepoSala $repoSala,
                                RepoReservasSalas $repoReservaSala,
                                RepoGrupo $repoGrupo,
                                RepoUser $repoUser,
                                RepoContacto $repoContacto,
                                RepoServicio $repoServicio,
                                RepoReservaEstado $repoReservaEstado,
                                RepoHorarios $repoHorarios,
                                FunctionsSpecials $functionsSpecials)
    {
        $this->repoSala = $repoSala;
        $this->repoReservaSala = $repoReservaSala;
        $this->repoGrupo = $repoGrupo;
        $this->repoContacto = $repoContacto;
        $this->repoUser = $repoUser;
        $this->ruta_index = route('calendario.index');
//        dd($this->repoUser);
        $this->view = "calendario/";
//        dd($this->repoUser->negocioActual());
        if(count($this->repoUser->negocioActual())>0)
            $this->id_negocio_principal = $this->repoUser->negocioActual()[0]->id_negocio;
        else
            $this->id_negocio_principal = "";
        $this->repoReservaEstado = $repoReservaEstado;
        $this->repoServicio = $repoServicio;
        $this->repoHorarios = $repoHorarios;
        $this->functionsSpecials = $functionsSpecials;
    }

    function index()
    {
//        dd(Auth::user()->tipo_usuario);
        if (Auth::user()->tipo_usuario != 1) {
//            dd(Auth::user()->negocioActual());
            $combo_grupos = $this->darComboGrupos();
            $combo_salas = $this->darComboSalas();
//            dd("hola");
            $combo_estados = $this->darComboEstadosReservas();
            $combo_servicios = $this->darComboServicios();
            $reserva = $this->repoReservaSala->getModel();
            $data_formulario = array('route' => 'calendario.actualizarGanadasPerdidas', 'method' => 'POST', 'id' => 'form');
            return View::make($this->view."calendario", compact("reserva","data_formulario","combo_salas", "combo_grupos","combo_estados","combo_servicios"));
        }
        else
        {
            return View::make("inicio", compact("combo_salas", "combo_grupos"));
        }

    }

    private function darComboSalas()
    {
//        dd($this->id_negocio_principal);
        if(Auth::user()->tipo_usuario != 1)
        {
            $combo_salas = $this->repoSala->darSalasXNegocio($this->id_negocio_principal);
            return Form::select('id_sala', $combo_salas,$this->repoSala->darSalaActual($this->id_negocio_principal), array('id' => 'id_sala',"class" => ""));
        }
        else
        {
            $combo_salas = $this->repoSala->darTodasSalas();
            return Form::select('id_sala', $combo_salas,null, array('id' => 'id_sala',"class" => ""));
        }
    }

    private function darComboGrupos()
    {
        $combo_grupos = $this->darListaGrupos();
        return Form::select('id_grupo', $combo_grupos,null, array('id' => 'id_grupo'));
    }

    private function darComboEstadosReservas()
    {
        $lista_estados = $this->darListaEstadosReservas();
        return Form::select('id_estado_reserva', $lista_estados,null, array('id' => 'id_estado_reserva', 'disabled' => true));
    }

    private function darComboServicios()
    {
        $lista_servicios = $this->darListaServicios();
        return Form::select('id_servicio', $lista_servicios,null, array('id' => 'id_servicio'));
    }

    public function darReservasXSala()
    {
        $id_sala = $_POST['id_sala'];
        return json_encode($this->repoReservaSala->darReservaXSala($id_sala,$this->id_negocio_principal));
    }

    public function darContactoPrincipal()
    {
        $id_grupo = $_POST['id_grupo'];
        $contacto = $this->repoContacto->darContactoPrincipal($id_grupo,$this->id_negocio_principal);
        return $contacto;
    }

    public function nuevoEvento()
    {
        $model   = $this->repoReservaSala->nuevaReservaSala();
        $data    = Input::all();
        $data['id_horario_inicio'] = $this->repoHorarios->obtenerIdPorHorario($this->functionsSpecials->completarCerosCalendario($data['hora_inicio']).":".$this->functionsSpecials->completarCerosCalendario($data['minuto_inicio']));
        $data['id_horario_fin'] = $this->repoHorarios->obtenerIdPorHorario($this->functionsSpecials->completarCerosCalendario($data['hora_fin']).":".$this->functionsSpecials->completarCerosCalendario($data['minuto_fin']));
        $manager = new ReservaSalaManager($model,$data);
        $manager->save();
        return $manager->getEntity()->id;
    }

    public function actualizarEvento()
    {
//        dd($_POST);
        $id_horario_inicio = $this->repoHorarios->obtenerIdPorHorario($this->functionsSpecials->completarCerosCalendario($_POST['hora_inicio']).":".$this->functionsSpecials->completarCerosCalendario($_POST['minuto_inicio']));
        $id_horario_fin = $this->repoHorarios->obtenerIdPorHorario($this->functionsSpecials->completarCerosCalendario($_POST['hora_fin']).":".$this->functionsSpecials->completarCerosCalendario($_POST['minuto_fin']));
        $reserva = $this->repoReservaSala->find($_POST['id']);
        if($this->repoReservaSala->validarReprogramacion($reserva,$_POST,$id_horario_inicio,$id_horario_fin))
            $_POST['id_estado_reserva'] = 2;

        $_POST['id_horario_inicio'] = $id_horario_inicio;
        $_POST['id_horario_fin'] = $id_horario_fin;

        $reserva->fill($_POST);
        $reserva->save();
        return $reserva->id_estado_reserva;
//        return $reserva->
    }

    public function eliminarEvento()
    {
        $id = $_POST['id'];
        $reserva = $this->repoReservaSala->find($id);
        $_POST['id_estado_reserva'] = 3;
        $reserva->fill($_POST);
        $reserva->save();
    }

    public function actualizarSalaPrincipal()
    {
        $id_sala = $_POST['id_sala'];
        $this->repoSala->actualizarSalaPrincipal($id_sala,$this->id_negocio_principal);
    }

    public function validarVencidas()
    {
        $id_sala = $_POST['id_sala'];
        $id_hora_actual = $this->repoHorarios->obtenerIdPorHorario(date("H:00"));
        $listado_vencidas = $this->repoReservaSala->darListaVencidas($id_sala,$id_hora_actual);
        $fecha_actual = date("Y-n-j");

//        dd($listado_vencidas[0]);
        if(count($listado_vencidas) > 0)
        {
            $combo_estado = array('4' => 'Ganada','5' => 'Perdida');
            return View::make($this->view."listado_vencidas", compact("listado_vencidas","combo_estado","fecha_actual"));
        }
    }

    public function actualizarGanadasPerdidas()
    {
        $id_sala = $_POST['id_sala'];
        $id_horario_actual = $this->repoHorarios->obtenerIdPorHorario(date("H:00"));
        $listado_ids = $this->repoReservaSala->darIdsVencidas($id_sala,$id_horario_actual);
        foreach ($listado_ids as $id)
            $this->repoReservaSala->actualizarVencidas($id,$_POST["id_estado$id"]);
    }

    private function darListaGrupos()
    {
        $lista_grupos = $this->repoGrupo->darGruposXNegocio($this->id_negocio_principal);
        return array('' => 'Seleccione') + $lista_grupos;

    }

    private function darListaEstadosReservas()
    {
        return $this->repoReservaEstado->darListaParaCombo();
    }

    private function darListaServicios()
    {
        return $this->repoServicio->darListaParaComboPorNegocio($this->id_negocio_principal);

    }

    public function validarDatos($id_horario_inicio = "",$id_horario_fin = "")
    {
        $model   = $this->repoReservaSala->nuevaReservaSala();
        $data    = Input::all();

//        dd($data);
        if($id_horario_inicio)
        {
            $data['id_horario_inicio'] = $id_horario_inicio;
            $data['id_horario_fin'] = $id_horario_fin;
        }
        if((!empty($data['id_horario_inicio']))||(!empty($data['id_horario_fin'])))
        {
            if($this->repoReservaSala->validarSuperposicion($data['fecha'],$this->repoSala->darSalaActual($this->id_negocio_principal),$data['id_horario_inicio'],$data['id_horario_fin'],$data['id']))
                $data['no_tiene_reserva'] = "";
            else
                $data['no_tiene_reserva'] = "No tiene";
        }
        else
        {
            $data['no_tiene_reserva'] = "No tiene";

        }

        $manager = new ReservaSalaManager($model,$data);
        return $manager->isValid();

    }

    function validarDatosCalendario()
    {
        $data = Input::all();
//        dd($data);
        $id_horario_inicio = $this->repoHorarios->obtenerIdPorHorario($this->functionsSpecials->completarCerosCalendario($data['hora_inicio']).":".$this->functionsSpecials->completarCerosCalendario($data['minuto_inicio']));
        $id_horario_fin = $this->repoHorarios->obtenerIdPorHorario($this->functionsSpecials->completarCerosCalendario($data['hora_fin']).":".$this->functionsSpecials->completarCerosCalendario($data['minuto_fin']));

        return $this->validarDatos($id_horario_inicio,$id_horario_fin);
    }


    public function store()
    {
        $model   = $this->repoReservaSala->nuevaReservaSala();
        $data    = Input::all();
        $data['id_estado_reserva'] = 1; // Programada por defecto
        $data['comentario'] = $data['body'];
        $fecha = explode("/",$data['fecha']);
        $data['dia'] = $fecha[0];
        $data['mes'] = $fecha[1];
        $data['anio'] = $fecha[2];
        $data['id_sala'] = $this->repoSala->darSalaActual($this->id_negocio_principal);
        $manager = new ReservaSalaManager($model,$data);
        $manager->save();
        return Redirect::route('calendario.index');


    }


    public function nuevoEventoResponsive()
    {
        $fecha_actual = date("d/m/Y");
        $action = "Agregar";
        $ruta_index = $this->ruta_index;
        $model = $this->repoReservaSala->nuevaReservaSala();
        $data_formulario = array('route' => 'calendario.store', 'method' => 'POST', 'id' => 'frmReserva');
        $combo_grupos = $this->darListaGrupos();
        $combo_estados = $this->darListaEstadosReservas();
        $combo_servicios = $this->darListaServicios();
        $combo_horarios = $this->repoHorarios->darListaHorarios();
        return View::make($this->view."form_responsive",compact("action","model","data_formulario","combo_grupos","combo_estados","combo_servicios","combo_horarios","ruta_index","fecha_actual"));

    }


    public function darComboEnd()
    {
        $id_horario_inicio = Input::get('start');
        $combo_horarios = $this->repoHorarios->getDataComboEnd($id_horario_inicio);
        return Field::select('id_horario_fin','Salida',$combo_horarios,null,['id' => 'end']);

    }



}