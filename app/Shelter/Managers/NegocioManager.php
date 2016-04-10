<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 12/03/15
 * Time: 15:55
 */

namespace Shelter\Managers;


class NegocioManager extends BaseManager{

    public function getRules()
    {
        return [
            'nombre' => 'required|min:4|max:100'.$this->entity->id,
            'principal_telefono' => 'required'.$this->entity->id,
            'principal_sala' => 'required'.$this->entity->id,
        ];
    }

    public function getMessages()
    {
        return [
            'nombre.required' => 'Debe ingresar un nombre del negocio'.$this->entity->id,
            'nombre.unique' => 'Ya existe en la base de datos el nombre del negocio'.$this->entity->id,
            'principal_telefono.required' => 'Debe seleccionar un telefono como principal'.$this->entity->id,
            'principal_sala.required' => 'Debe seleccionar una sala como principal'.$this->entity->id
        ];
    }
}