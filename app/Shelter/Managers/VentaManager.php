<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 04/04/15
 * Time: 19:25
 */

namespace Shelter\Managers;


class VentaManager extends BaseManager {

    public function getRules()
    {
        return [
            'id_grupo' => 'required'
        ];
    }

    public function isValid()
    {
        $rules        = $this->getRules();
        $messages     = $this->getMessages();
        $validation   = \Validator::make($this->data,$rules,$messages);
        $isValid      = $validation->passes();
        $this->errors = $validation->errors();

//        dd($isValid);
        if(!$isValid)
            return $this->mostrarErrores($isValid);
        else
        {
            if(count(\Session::get("ventas")) == 0)
                return "Debe ingresar al menos un producto";
        }
    }

    public function getMessages()
    {
        return [
            'id_grupo.required' => 'El campo grupo es requerido'
        ];
    }




} 