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
        $fecha = date("Y-m-d");
//        dd($id_negocio);
//        $servicios = $this->getModel()->
//            where('id_negocio',$id_negocio)->
//            where('vigencia_desde','=<',date("Y-m-d"))->
//            where('vigencia_hasta','>=',date("Y-m-d"))->
//            lists('nombre', 'id');


        $servicios = $this->getModel()->
                            whereRaw("`id_negocio` = $id_negocio
                            and `vigencia_desde` <= '$fecha' and
                            `vigencia_hasta` >= '$fecha'")->lists('nombre', 'id');

//        dd($servicios);
//                $queries = \DB::getQueryLog();
//        $last_query = end($queries);
//        print_r($last_query);

        return $servicios;
    }


} 