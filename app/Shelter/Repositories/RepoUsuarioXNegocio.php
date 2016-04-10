<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 13/03/15
 * Time: 13:13
 */
namespace Shelter\Repositories;
use Shelter\Entities\UsuarioXNegocio;

class RepoUsuarioXNegocio extends RepoBase
{

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new UsuarioXNegocio();

    }

    public function nuevoUsuarioXNegocio()
    {
        return $this->getModel();
    }

    public function tieneNegocioPrincipal($id_usuario)
    {
        $resultado = $this->getModelwhere("id_usuario",$id_usuario)->where("principal",1)->get(array("id"));
        if(count($resultado) > 0)
            return true;
        else
            return false;
    }

    public function guardarListaNegocios($id_usuario,$lista_negocios)
    {
        if(is_array($lista_negocios)) {
            $ban = true;
            foreach ($lista_negocios as $id_negocio) {
                if($ban)
                {
                    $this->getModel()->insert(array(
                        'id_negocio' => $id_negocio,
                        'id_usuario' => $id_usuario,
                        'principal' => 1
                    ));
                    $ban = 0;
                }
                else
                {
                    $this->getModel()->insert(array(
                        'id_negocio' => $id_negocio,
                        'id_usuario' => $id_usuario,
                        'principal' => 0
                    ));
                }
            }
        }
    }

    public function guardarListaUsuarios($id_negocio,$lista_usuarios)
    {
        if(is_array($lista_usuarios)) {
            foreach ($lista_usuarios as $id_usuario)
            {
                if(!UsuarioXNegocio::tieneNegocioPrincipal($id_usuario))
                {
                    $this->getModel()->insert(array(
                        'id_negocio' => $id_negocio,
                        'id_usuario' => $id_usuario,
                        'principal' => 1
                    ));
                }
                else
                {
                    $this->getModel()->insert(array(
                        'id_negocio' => $id_negocio,
                        'id_usuario' => $id_usuario,
                        'principal' => 0
                    ));

                }
            }
        }
    }


    public function darNegociosSeleccionadosPorUsuario($id_usuario)
    {
        $lista = $this->getModel()->orderBy('usuariosxnegocios.principal','desc')->
        join('negocios', 'negocios.id', '=', 'usuariosxnegocios.id_negocio')->
        where('negocios.estado',0)->
        where('usuariosxnegocios.id_usuario',$id_usuario)->
        get(array('negocios.id','negocios.nombre','negocios.estado','usuariosxnegocios.principal'));
        $array = array();
        foreach($lista as $l)
        {
            array_push($array,$l);
        }
        return $array;
    }

    public function darUsuariosSeleccionadosPorNegocio($id_negocio)
    {
        $lista = $this->getModel()->orderBy('users.username','asc')->
        join('users', 'users.id', '=', 'usuariosxnegocios.id_usuario')->
        where('users.estado',0)->
        where('usuariosxnegocios.id_negocio',$id_negocio)->
        get(array('users.id','users.username','users.estado'));
        $array = array();
        foreach($lista as $l)
        {
            array_push($array,$l);
        }
        return $array;
    }

    public function eliminarNegociosPorUsuario($id_usuario)
    {
        $this->getModel()->where('id_usuario',$id_usuario)->delete();
    }

    public function eliminarUsuariosPorNegocio($id_negocio)
    {
        $this->getModel()->where('id_negocio',$id_negocio)->delete();
    }

    public function actualizarNegocioAdministrado($id_usuario,$id_negocio)
    {
        $this->getModel()->where("id_usuario",$id_usuario)->update(
            array("principal" => 0)
        );
        $this->getModel()->where("id_usuario",$id_usuario)->where("id_negocio",$id_negocio)->update(
            array("principal" => 1)
        );

    }

    public function darNegocioActual($id_usuario)
    {
        return $this->getModel()->where("id_usuario",$id_usuario)->where("principal",1)->get(array("id_negocio"));
    }


}