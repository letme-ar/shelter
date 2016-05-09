<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 07/05/16
 * Time: 20:51
 */

namespace Shelter\Repositories;


use Shelter\Components\Field;
use Shelter\Entities\Horario;

class RepoHorarios extends RepoBase
{

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new Horario();

    }

    public function obtenerIdPorHorario($horario)
    {
        $obj = $this->getModel()->where("horario",$horario)->first();
        return $obj->id;

    }

    public function darListaHorarios()
    {
        return $this->getModel()->lists('horario', 'id');
    }

    public function getDataComboEnd($id_horario_inicio)
    {
        return $this->getModel()->where('id', ">", $id_horario_inicio)->lists("horario","id");
    }

    /*    public function guardar($id_grupo,$nro_integrante,$nombrecontacto,$telefonocontacto,$principal,$id_negocio)
        {
            $this->getModel()->insert(array(
                'id_grupo' => $id_grupo,
                'nro_integrante' => $nro_integrante,
                'nombrecontacto' => $nombrecontacto,
                'telefonocontacto' => $telefonocontacto,
                'principal' => $principal,
                'id_negocio' => $id_negocio

            ));
        }

        public function listadoPorGrupo($id_grupo,$id_negocio)
        {
            $results = $this->getModel()->where("id_grupo",$id_grupo)->where("id_negocio",$id_negocio)->
            orderBy('nro_integrante','asc')->get();
            return $results;
        }

        public function eliminarContactosPorGrupo($id_grupo,$id_negocio)
        {
            $this->getModel()->where('id_grupo',$id_grupo)->where('id_negocio',$id_negocio)->delete();
        }

        public function darContactoPrincipal($id_grupo,$id_negocio)
        {
            $results = $this->getModel()->where("id_grupo",$id_grupo)->where("id_negocio",$id_negocio)->where("principal",1)->get();
            return $results[0]->nombrecontacto. ": ".$results[0]->telefonocontacto;
        }*/

}