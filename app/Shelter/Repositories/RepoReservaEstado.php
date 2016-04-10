<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 27/06/15
 * Time: 15:05
 */
namespace Shelter\Repositories;
use Shelter\Entities\ReservaEstado;

class RepoReservaEstado extends RepoBase {

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new ReservaEstado();

    }

    public function nuevoEstadoReserva()
    {
        return $this->getModel();
    }

    public function darListaParaCombo()
    {
        $estilos = $this->getModel()->lists('estado', 'id');
        return $estilos;
    }

    /*public static function listado()    {
        $results = self::orderBy('eliminado','asc')->get();
        return $results;
    }*/
}