<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 13/03/15
 * Time: 10:28
 */
namespace Shelter\Repositories;
use Shelter\Entities\Telefono;

class RepoTelefono extends RepoBase
{

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new Telefono();

    }

    public function nuevoTelefono()
    {
        return $this->getModel();
    }

    public function guardar($id_negocio,$lista_telefonos,$reg_principal_telefono)
    {
        $lista_telefonos = unserialize(serialize($lista_telefonos));
        foreach($lista_telefonos as $telefono)
        {
            if($telefono->telefono == $reg_principal_telefono)
                $principal = 1;
            else
                $principal = 0;

            $this->model->insert(array(
                'id_negocio' => $id_negocio,
                'telefono' => $telefono->telefono,
                'principal' => $principal
            ));
        }
    }

    public function listadoPorNegocio($id_negocio)
    {
        $results = $this->model->where("id_negocio",$id_negocio)->get();
        return $results;
    }

    public function eliminarTelefonoPorNegocio($id_negocio)
    {
        $this->model->where('id_negocio',$id_negocio)->delete();
    }

}