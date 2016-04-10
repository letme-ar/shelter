<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 14/03/15
 * Time: 21:41
 */

namespace Shelter\Managers;

class ReservaSalaManager extends BaseManager{

    public function getRules()
    {
        return [
            'id_grupo' => 'required',
            'start' => 'required',
            'end' => 'required'

        ];
    }

    public function getMessages()
    {
        return [
            'id_grupo.required' => 'El grupo es requerido',
            'start.required' => 'El ingreso es requerido',
            'end.required' => 'La salida es requerida'
        ];
    }

}