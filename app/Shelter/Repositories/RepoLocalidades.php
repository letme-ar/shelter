<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 13/03/15
 * Time: 12:17
 */
namespace Shelter\Repositories;
use Shelter\Entities\Localidad;

class RepoLocalidades extends RepoBase {

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new Localidad();

    }

    public function nuevaLocalidad()
    {
        return $this->getModel();
    }

    private function getWithRelations(){
        return
            $this->model
                ->with('getProvincia');
    }

    public function darListaParaCombo($id_provincia)
    {
        $localidades = $this->model->where("id_provincia",$id_provincia)->lists('localidad', 'id');
        return $localidades;
    }

    public function listado()    {
        $results = $this->model->orderBy('id','asc')->get();
        return $results;
    }

    public function getById($id){
        return $this->getWithRelations()->where('id','=',$id)->get()->first();
    }

    public function darProvincia($id)
    {
        $results = $this->model->where("id",$id)->get(array("id_provincia"));
        if(count($results) > 0)
            return $results[0]->id_provincia;
        else
            return "";


    }

}