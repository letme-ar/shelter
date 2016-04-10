<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 21/03/15
 * Time: 20:46
 */

namespace Shelter\Repositories;
use Shelter\Entities\Servicio;

class RepoServicio extends RepoBase {

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new Servicio();

    }

    public function nuevoServicio()
    {
        return $this->getModel();
    }

    public function darServiciosPorNegocio($id_negocio)
    {
        return $this->where("id_negocio",$id_negocio)->all();
    }

    public function darListaParaComboPorNegocio($id_negocio)
    {
//        dd(date("Y-m-d"));
        $servicios = $this->getModel()->
            where('id_negocio',$id_negocio)->
            where('vigencia_desde','<',date("Y-m-d"))->
            where('vigencia_hasta','>',date("Y-m-d"))->
            lists('nombre', 'id');
        return $servicios;
    }


} 