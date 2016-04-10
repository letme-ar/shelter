<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 13/03/15
 * Time: 18:41
 */
namespace Shelter\Repositories;
use Shelter\Entities\TipoUsuario;

class RepoTipoUsuario extends RepoBase
{

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new TipoUsuario();

    }

    public function nuevoTipoUsuario()
    {
        return $this->getModel();
    }

    public function darListaParaCombo()
    {
        $estilos = $this->getModel()->where('activo', 0)->lists('tipo_usuario', 'id');
        return $estilos;
    }

    public function listado()
    {
        $results = $this->getModel()->orderBy('activo', 'asc')->get();
        return $results;
    }
}