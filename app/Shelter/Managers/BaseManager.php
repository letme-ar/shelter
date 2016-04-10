<?php
/**
 * Created by PhpStorm.
 * User: Damián
 * Date: 12/03/15
 * Time: 14:29
 */

namespace Shelter\Managers;



abstract class BaseManager {

    protected $entity;
    protected $data;
    protected $errors;

    public function __construct($entity, $data){

        $this->entity = $entity;
        //$this->data   = array_only($data,array_keys($this->getRules()));
        $this->data   = $data;

    }

    abstract public function getRules();

    abstract public function getMessages();

    public function isValid(){
        $rules        = $this->getRules();
        $messages     = $this->getMessages();
        $validation   = \Validator::make($this->data,$rules,$messages);
        $isValid      = $validation->passes();
        $this->errors = $validation->errors();
        return $this->mostrarErrores($isValid);
    }

    public function mostrarErrores($isValid)
    {
        $mensaje = "";
        if(!$isValid)
        {
            foreach ($this->getErrors()->all() as $error)
            {
                $mensaje .= $error."<br>";
            }
            return $mensaje;
        }
    }

    public function getErrors(){

        return $this->errors;

    }

    public function prepareData($data)
    {
        return $data;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function save(){
        $this->data = $this->prepareData($this->data);
        $this->entity->fill($this->data);
//        dd($this->getEntity());
        if($this->entity->save()) return true;
        return false;
    }



} 