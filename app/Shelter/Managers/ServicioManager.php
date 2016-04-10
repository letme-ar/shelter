<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 21/03/15
 * Time: 20:44
 */

namespace Shelter\Managers;
use Shelter\Components\FunctionsSpecials;

class ServicioManager extends BaseManager {

    public function getRules()
    {
        return [
            'nombre' => 'required|min:3|max:100'.$this->entity->id,
            'vigencia_desde' => 'required'.$this->entity->id,
            'vigencia_hasta' => 'required'.$this->entity->id,
            'precio_venta' => 'required|numeric'.$this->entity->id,
        ];
    }

    public function getMessages()
    {
        return [
            'vigencia_desde.required' => 'El campo inicio de vigencia es requerido',
            'vigencia_hasta.required' => 'El campo fin de vigencia es requerido',
            'precio_venta.required' => 'El campo precio de venta es requerido'
        ];
    }

    public function prepareData($data)
    {
        $functionsSpecials = new FunctionsSpecials();

        $data['id_negocio'] = \Auth::user()->negocioActual()[0]->id_negocio;
        $data['vigencia_desde'] = $functionsSpecials->DateNormalToMysqo($data['vigencia_desde']);
        $data['vigencia_hasta'] = $functionsSpecials->DateNormalToMysqo($data['vigencia_hasta']);
//        dd($data['vigencia_hasta']);
        return $data;
    }


} 