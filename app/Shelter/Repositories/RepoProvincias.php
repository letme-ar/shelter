<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 13/03/15
 * Time: 12:10
 */
namespace Shelter\Repositories;
use Shelter\Entities\Provincia;

class RepoProvincias extends RepoBase
{

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new Provincia();

    }

    public function nuevaProvincia()
    {
        return $this->getModel();
    }

    public function darListaParaCombo()
    {
        $provincias = $this->model->lists('provincia', 'id');
        return $provincias;
    }

    public function listado()    {
        $results = $this->model->orderBy('id','asc')->get();
        return $results;
    }



}
