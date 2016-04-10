<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 25/10/14
 * Time: 22:58
 */
class Negocio2 extends Eloquent
{
    protected $table = 'negocios';
    protected $fillable = array('id', 'nombre','direccion','id_localidad','mail','facebook','twitter','web','estado');

    /*public static function getIdNegocioPorUsuario($id_usuario)
    {
        $resultado = self::where('id_usuario',$id_usuario)->get(array('id'));
        if(count($resultado) > 0)
            return $resultado[0]->id;
        else
            return false;
    }*/

    public function isValid($data,$id="")  {

        $rules = array(
            'nombre' => 'required|min:4|max:100',
            'principal_telefono' => 'required',
            'principal_sala' => 'required'
        );

        if ($this->exists)
        {
            //Evitamos que la regla “unique” tome en cuenta el email del usuario actual
            $rules['nombre'] .= ',negocio,' . $id;
        }


        $messages = array(
            'nombre.required' => 'Debe ingresar un nombre del negocio',
            'nombre.unique' => 'Ya existe en la base de datos el nombre del negocio',
            'principal_telefono.required' => 'Debe seleccionar un telefono como principal',
            'principal_sala.required' => 'Debe seleccionar una sala como principal'
        );

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->passes())
        {
            return true;
        }

        $this->errors = $validator->errors();

        return false;
    }

    public static function listado()
    {
        $results = self::orderBy('id','asc')
            ->leftJoin('localidades', 'negocios.id_localidad', '=', 'localidades.id')
            ->leftJoin('telefonos', function ($join) {
                $join->on('negocios.id', '=', 'telefonos.id_negocio')
                    ->where('telefonos.principal', '=', 1);
            })
            ->get(array('negocios.id as id','localidades.localidad as id_localidad','negocios.nombre','negocios.direccion','negocios.facebook','negocios.estado','telefonos.telefono'));
        foreach($results as $r)
            $r->estado = HelperEstado::darEstado($r->estado);
        return $results;
    }

    public static function darListaNegocios($id_usuario="")
    {
        if($id_usuario)
        {
            return self::whereNotIn('id', function($query) use ($id_usuario)
                {
                    $query->select("id_negocio")
                        ->from('usuariosxnegocios')
                        ->where('usuariosxnegocios.id_usuario',$id_usuario);
                })
                ->get(array('negocios.id','negocios.nombre','negocios.estado'));
        }
        else
            return self::where('estado',0)->get(array('id','nombre','estado'));
    }

    public function cambiarEstado($id,$estado)
    {
        if($estado == "Activo")
        {
            self::where("id",$id)->update(
                array("estado" => 1)
            );
        }
        else
        {
            self::where("id",$id)->update(
                array("estado" => 0)
            );

        }
    }


}