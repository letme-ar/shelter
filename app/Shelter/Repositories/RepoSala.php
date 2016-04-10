<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 13/03/15
 * Time: 10:47
 */
namespace Shelter\Repositories;
use Shelter\Entities\Sala;

class RepoSala extends RepoBase
{

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new Sala();

    }

    public function nuevaSala()
    {
        return $this->getModel();
    }

    public function guardar($id_negocio,$lista_salas,$reg_principal_sala)
    {
        $lista_salas = unserialize(serialize($lista_salas));
        foreach($lista_salas as $sala) {
            if ($sala->sala == $reg_principal_sala)
                $principal = 1;
            else
                $principal = 0;

            $this->getModel()->insert(array(
                'id_negocio' => $id_negocio,
                'sala' => $sala->sala,
                'principal' => $principal
            ));
        }
    }

    public function listadoPorNegocio($id_negocio)
    {
        $results = $this->getModel()->where("id_negocio",$id_negocio)->get();
        return $results;
    }

    public function eliminarSalaPorNegocio($id_negocio)
    {
        $this->getModel()->where('id_negocio',$id_negocio)->delete();
    }

    public function darSalasXNegocio($id_negocio)
    {
        return $this->getModel()->where("id_negocio",$id_negocio)->lists("sala","id");
    }

    public function darTodasSalas()
    {
        return $this->getModel()->lists("sala","id");
    }

    public function darSalaActual($id_negocio)
    {
        $res = $this->getModel()->where("id_negocio",$id_negocio)->where("principal",1)->get(array("id"));
        return $res[0]->id;
    }

    public function actualizarSalaPrincipal($id,$id_negocio_actual)
    {
        $this->getModel()->where("id_negocio",$id_negocio_actual)->update(
            array("principal" => 0)
        );

        $this->getModel()->where("id",$id)->where("id_negocio",$id_negocio_actual)
            ->update(
                array("principal" => 1)
            );
    }
}