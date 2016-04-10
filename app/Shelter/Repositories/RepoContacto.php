<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 14/03/15
 * Time: 21:20
 */
namespace Shelter\Repositories;
use Shelter\Entities\Contacto;

class RepoContacto extends RepoBase {

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new Contacto();

    }

    public function nuevoContacto()
    {
        return $this->getModel();
    }

    public function guardar($id_grupo,$nro_integrante,$nombrecontacto,$telefonocontacto,$principal,$id_negocio)
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
    }
}