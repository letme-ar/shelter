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
            'id_horario_inicio' => 'required',
            'id_horario_fin' => 'required',
            'no_tiene_reserva' => 'required',

        ];
    }

    public function getMessages()
    {
        return [
            'id_grupo.required' => 'El grupo es requerido',
            'id_horario_inicio.required' => 'El ingreso es requerido',
            'id_horario_fin.required' => 'La salida es requerida',
            'no_tiene_reserva.required' => 'Ya hay una reserva dentro del rango seleccionado'
        ];
    }

}