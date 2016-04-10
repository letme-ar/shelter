<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 12/03/15
 * Time: 14:27
 */
namespace Shelter\Managers;


class EstiloManager extends BaseManager{

    public function getRules()
    {
        return [
            'estilo' => 'required|min:4|max:60|unique:estilos'.$this->entity->id,
        ];
    }
}