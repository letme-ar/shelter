<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 12/03/15
 * Time: 14:35
 */
namespace Shelter\Repositories;
use Shelter\Entities\Estilo;

class RepoEstilos extends RepoBase {

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new Estilo();

    }

    public function getData()
    {
        return $this->model->where('eliminado','=',0)->get(["nombre as description","id","estilo"]);

    }

    public function nuevoEstilo()
    {
        return $this->getModel();
    }

    public static function darListaParaCombo()
    {
        $estilos = self::where('eliminado',0)->lists('estilo', 'id');
        return $estilos;
    }

    public static function listado()    {
        $results = self::orderBy('eliminado','asc')->get();
        return $results;
    }
}