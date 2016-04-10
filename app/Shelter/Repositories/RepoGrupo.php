<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 14/03/15
 * Time: 19:49
 */
namespace Shelter\Repositories;
use Shelter\Entities\Grupo;

class RepoGrupo extends RepoBase {

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new Grupo();

    }

    public function getData()
    {
        return $this->model->where('eliminado','=',0)->get(["nombre as description","id","estilo"]);

    }

    public function getList()
    {
        $grupos = $this->getModel()->where('eliminado','=','0')->lists('nombre', 'id');
        $combo_grupos = array('' => 'Seleccione') + $grupos;
        return $combo_grupos;
    }


    public function nuevoGrupo()
    {
        return $this->getModel();
    }

    public function estilo(){
        return $this->hasOne('Estilo','id','id_estilo');
    }

    public function buscarGruposPorNombre($nombre)
    {
        $resultado = $this->getModel()->where('nombre','like','%'.$nombre.'%')->get();
        if(count($resultado) > 0)
        {
            $array = array();
            foreach ($resultado as $r)
            {
                array_push($array,$r->nombre);
            }
            return $array;
        }
        else
            return array();
    }

    public function buscarGrupoPorNombre($nombre)
    {
        $resultado = $this->getModel()->where('nombre',$nombre)->get();
        if(count($resultado) > 0)
            return $resultado[0];
        else
            return false;
    }

    public function isValid($data,$id="")  {

        if(Auth::user()->tipo_usuario != 1)
        {
            $rules = array(
                'nombre' => 'required|min:4|max:100',
                'id_estilo' => 'required',
                'principal' => 'required'
            );
        }
        else
        {
            $rules = array(
                'nombre' => 'required|min:4|max:100',
                'id_estilo' => 'required',
                'principal' => 'sometimes|required|principal'
            );
        }

        if ($this->exists)
        {
            //Evitamos que la regla “unique” tome en cuenta el email del usuario actual
            $rules['nombre'] .= ',nombre,' . $id;
        }


        $messages = array(
            'nombre.required' => 'Debe ingresar un nombre de grupo',
            'nombre.unique' => 'Ya existe en la base de datos el nombre del grupo',
            'id_estilo.required' => 'Debe seleccionar un estilo de música',
            'principal.required' => 'Debe seleccionar un contacto como principal'
        );

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->passes())
        {
            return true;
        }

        $this->errors = $validator->errors();

        return false;
    }

    public function eliminarGrupo($id)
    {
        $this->getModel()->where('id', $id)
            ->update(array('eliminado' => 1));
    }

    public function darGruposXNegocio($id_negocio)
    {
        return $this->getModel()->where("gruposxnegocios.id_negocio",$id_negocio)
            ->where("grupos.eliminado",0)
            ->join("gruposxnegocios","gruposxnegocios.id_grupo","=","grupos.id")
            ->lists("nombre","id_grupo");
    }
}