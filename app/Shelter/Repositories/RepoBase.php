<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 12/03/15
 * Time: 14:34
 */
namespace Shelter\Repositories;


abstract class RepoBase {

    protected $model;
    abstract public function getModel();

    function __construct(){
        $this->model = $this->getModel();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function all()
    {

        return $this->model->all();

    }

    public function combos($nombre="description",$id="id"){

        return $this->model->lists($nombre,$id);

    }

    public function combosNoEliminados($nombre="description",$id="id",$campo="eliminado"){
        return $this->model->where($campo,'=',0)->lists($nombre,$id);
    }


    public function combosCache($nombre="description",$id="id",$tiempoCache=60){

        return $this->model->remember($tiempoCache)->lists($nombre,$id);



    }

    public  function combosOrderBy($campoOrder,$order,$nombre="description",$id="id"){

        return $this->model->orderBy($campoOrder,$order)->lists($nombre,$id);;

    }

    public  function combosOrderCache($campoOrder,$order,$nombre="description",$id="id",$tiempoCache=60){

        return $this->model
            ->orderBy($campoOrder,$order)
            ->remember($tiempoCache)
            ->lists($nombre,$id);
    }




    public function where($campo,$valor){

        return $this->model->where($campo,'=',$valor)->get();


    }

    public function paginate($limit = 15){
        return $this->model->paginate($limit);

    }


}