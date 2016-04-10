<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 14/03/15
 * Time: 19:48
 */
namespace Shelter\Managers;

class GrupoManager extends BaseManager{

    public function getRules()
    {
        if(\Auth::user()->tipo_usuario != 1)
        {
            return [
                    'nombre' => 'required|min:4|max:100',
                    'id_estilo' => 'required',
                    'principal' => 'required'
                ];
        }
        else
        {
            return [
                'nombre' => 'required|min:4|max:100',
                'id_estilo' => 'required',
                'principal' => 'sometimes|required|principal'
            ];
        }
    }

    public function getMessages()
    {
        return [
            'nombre.required' => 'Debe ingresar un nombre de grupo',
            'nombre.unique' => 'Ya existe en la base de datos el nombre del grupo',
            'id_estilo.required' => 'Debe seleccionar un estilo de música',
            'principal.required' => 'Debe seleccionar un contacto como principal'
        ];
    }

}