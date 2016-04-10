<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 12/03/15
 * Time: 15:57
 */

namespace Shelter\Repositories;
use Shelter\Entities\Negocio;

class RepoNegocios extends RepoBase {

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new Negocio();

    }

    public function nuevoNegocio()
    {
        return $this->getModel();
    }

    public function getData()
    {
        return $this->model->where('eliminado','=',0)->get(["nombre as description","id","estilo"]);
    }

    public function listado()
    {
        $results = $this->model->orderBy('id','asc')
            ->leftJoin('localidades', 'negocios.id_localidad', '=', 'localidades.id')
            ->leftJoin('telefonos', function ($join) {
                $join->on('negocios.id', '=', 'telefonos.id_negocio')
                    ->where('telefonos.principal', '=', 1);
            })
            ->get(array('negocios.id as id','localidades.localidad as id_localidad','negocios.nombre','negocios.direccion','negocios.facebook','negocios.estado','telefonos.telefono'));
        foreach($results as $r)
            $r->estado = \HelperEstado::darEstado($r->estado);
        return $results;
    }

    public function darListaNegocios($id_usuario="")
    {
        if($id_usuario)
        {
            return $this->model->whereNotIn('id', function($query) use ($id_usuario)
            {
                $query->select("id_negocio")
                    ->from('usuariosxnegocios')
                    ->where('usuariosxnegocios.id_usuario',$id_usuario);
            })
                ->get(array('negocios.id','negocios.nombre','negocios.estado'));
        }
        else
            return $this->model->where('estado',0)->get(array('id','nombre','estado'));
    }

    public function cambiarEstado($id,$estado)
    {
        if($estado == "Activo")
        {
            $this->model->where("id",$id)->update(
                array("estado" => 1)
            );
        }
        else
        {
            $this->model->where("id",$id)->update(
                array("estado" => 0)
            );

        }
    }


}