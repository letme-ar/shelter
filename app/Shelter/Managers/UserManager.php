<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 13/03/15
 * Time: 13:30
 */
namespace Shelter\Managers;

class UserManager extends BaseManager{

    public function getRules()
    {
        return [
            'nombre' => 'required|min:4|max:50',
            'apellido' => 'required|min:3|max:50',
            'username' => 'required|min:4|max:50',
            'tipo_usuario' => 'required',
            'negocios_seleccionados' => 'required'
        ];
    }

    public function getMessages()
    {
        return [
            'nombre.required' => 'Debe ingresar el nombre del usuario',
            'nombre.min' => 'El nombre debe ser de al menos 4 caracteres',
            'nombre.max' => 'El nombre debe ser de menos de 50 caracteres',
            'apellido.required' => 'Debe ingresar el apellido del usuario',
            'apellido.min' => 'El apellido debe ser de al menos 3 caracteres',
            'apellido.max' => 'El apellido debe ser de menos de 50 caracteres',
            'username.required' => 'Debe ingresar el usuario',
            'username.min' => 'El usuario debe ser de al menos 4 caracteres',
            'username.max' => 'El usuario debe ser de menos de 50 caracteres',
            'tipo_usuario.required' => 'Debe seleccionar el tipo del usuario',
            'negocios_seleccionados.required' => 'El usuario debe tener a menos un negocio seleccionado'
        ];
    }


}