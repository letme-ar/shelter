<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 13/03/15
 * Time: 13:32
 */
namespace Shelter\Repositories;
use Shelter\Entities\User;

class RepoUser extends RepoBase
{

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new User();

    }

    public function nuevoUser()
    {
        return $this->getModel();
    }

    public function listado()
    {
        $results = $this->getModel()->orderBy('id','asc')
            ->leftJoin('tipos_usuarios', 'users.tipo_usuario', '=', 'tipos_usuarios.id')
            ->get(array('users.id as id','tipos_usuarios.tipo_usuario as tipo_usuario','users.nombre as nombre','users.apellido as apellido','users.username as username','users.estado','users.password'));
        return $results;
    }

    public function cambiarEstado($id,$estado)
    {
        if($estado == "Activo")
        {
            $this->getModel()->where("id",$id)->update(
                array("estado" => 1)
            );
        }
        else
        {
            $this->getModel()->where("id",$id)->update(
                array("estado" => 0)
            );

        }
    }

    public function reiniciarPassword($id)
    {
        $this->getModel()->where("id",$id)->update(
            array("password" => \Hash::make("123456"))
        );
    }





    public function darListaUsuarios($id_negocio="")
    {
        if($id_negocio)
        {
            return $this->getModel()->whereNotIn('id', function($query) use ($id_negocio)
            {
                $query->select("id_usuario")
                    ->from('usuariosxnegocios')
                    ->where('usuariosxnegocios.id_negocio',$id_negocio);
            })
                ->get(array('users.id','users.username','users.estado'));
        }
        else
            return $this->getModel()->where('estado',0)->get(array('id','username','estado'));
    }

    public function negocioActual()
    {
        $usuarioxnegocio = new RepoUsuarioXNegocio();
        return $usuarioxnegocio->darNegocioActual(\Auth::user()->id);
    }


}
