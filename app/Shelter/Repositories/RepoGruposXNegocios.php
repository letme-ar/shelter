<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 14/03/15
 * Time: 19:30
 */
namespace Shelter\Repositories;
use Shelter\Entities\GruposXNegocios;

class RepoGruposXNegocios extends RepoBase
{

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new GruposXNegocios();

    }

    public function nuevoGrupoXNegocio()
    {
        return $this->getModel();
    }

    public function validarGrupoXNegocio($id_grupo,$id_negocio)
    {
        $resultado = $this->getModel()->where('id_grupo',$id_grupo)
            ->where('id_negocio',$id_negocio)->get();
        if(count($resultado) > 0)
            return false;
        else
            return true;
    }


    public function estilo(){
        return $this->hasOne('Estilo','id','id_estilo');
    }

//    public function darGrupoXNegocio()






    public function listado()    {
//        dd(Auth::user()->tipo_usuario);
        if(\Auth::user()->tipo_usuario == 1)
        {
            $results = \DB::table("grupos")->orderBy('usuariosxnegocios.id_negocio', 'asc')
                ->distinct()
                ->leftJoin('gruposxnegocios', 'grupos.id', '=', 'gruposxnegocios.id_grupo')
                ->join('estilos', 'grupos.id_estilo', '=', 'estilos.id')
                ->leftJoin('usuariosxnegocios', 'usuariosxnegocios.id_negocio', '=', 'gruposxnegocios.id_negocio')
                ->leftJoin('negocios', 'negocios.id', '=', 'usuariosxnegocios.id_negocio')
                ->leftJoin('contactos', function ($join) {
                    $join->on('grupos.id', '=', 'contactos.id_grupo')
                        ->on('usuariosxnegocios.id_negocio', "=", "contactos.id_negocio")
                        ->where('contactos.principal', '=', 1);
                })
                ->get(array('grupos.id', 'grupos.nombre', 'grupos.id_estilo', 'grupos.web', 'grupos.facebook', 'grupos.twitter', 'grupos.integrantes', 'grupos.eliminado', 'contactos.principal', 'contactos.nombrecontacto', 'contactos.telefonocontacto','estilos.estilo','usuariosxnegocios.id_negocio','negocios.nombre as negocio'));


        }
        else {
            $results = $this->getModel()->orderBy('grupos.eliminado', 'asc')
                ->distinct()
                ->join('grupos', 'grupos.id', '=', 'gruposxnegocios.id_grupo')
                ->join('estilos', 'grupos.id_estilo', '=', 'estilos.id')
                ->join('usuariosxnegocios', 'usuariosxnegocios.id_negocio', '=', 'gruposxnegocios.id_negocio')
                ->leftJoin('contactos', function ($join) {
                    $join->on('grupos.id', '=', 'contactos.id_grupo')
                        ->on('usuariosxnegocios.id_negocio', "=", "contactos.id_negocio")
                        ->where('contactos.principal', '=', 1);
                })
                ->where("usuariosxnegocios.id_negocio","=", \Auth::user()->negocioActual()[0]->id_negocio)
                ->get(array('grupos.id', 'grupos.nombre', 'grupos.id_estilo', 'grupos.web', 'grupos.facebook', 'grupos.twitter', 'grupos.integrantes', 'grupos.eliminado', 'contactos.principal', 'contactos.nombrecontacto', 'contactos.telefonocontacto','estilos.estilo','usuariosxnegocios.id_negocio'));
        }

        return $results;
    }

}

    