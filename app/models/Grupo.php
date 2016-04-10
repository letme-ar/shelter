<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 01/09/14
 * Time: 16:03
 */
class Grupo2 extends Eloquent
{
    protected $table = 'grupos';
    protected $fillable = array('id', 'nombre','id_estilo','web','facebook','twitter','integrantes','eliminado','id_usuario_creador');
    public $errors;



    public function estilo(){
        return $this->hasOne('Estilo','id','id_estilo');
    }

    public static function buscarGruposPorNombre($nombre)
    {
        $resultado = self::where('nombre','like','%'.$nombre.'%')->get();
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

    public static function buscarGrupoPorNombre($nombre)
    {
        $resultado = self::where('nombre',$nombre)->get();
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
        self::where('id', $id)
            ->update(array('eliminado' => 1));
    }

    public static function darGruposXNegocio($id_negocio)
    {
        return self::where("gruposxnegocios.id_negocio",$id_negocio)
            ->where("grupos.eliminado",0)
            ->join("gruposxnegocios","gruposxnegocios.id_grupo","=","grupos.id")
            ->lists("nombre","id_grupo");
    }


    /*public static function listadoAltasOperativas()    {
        $results = self::paginate(10);
        return $results;
    }

    public function darNroRegistro($id_perro)
    {
        $id = self::where('id_perro',$id_perro)
            ->max('nro_registro');
        return $id+1;
    }

    public function perro(){
        return $this->hasOne('Perro','id','id_perro');
    }

    public function area(){

        return $this->hasOne('Area','id','id_area');
    }

    public function especialidad(){

        return $this->hasOne('Especialidad','id','id_especialidad');
    }

    public function guardarListaAltaOperativaxOlores($id_alta_operativa,$lista_olores = array())
    {
        if(is_array($lista_olores)) {
            foreach ($lista_olores as $id_olor) {
                DB::table('altas_operativasxolores')->insert(
                    array('id_olor' => $id_olor,
                        'id_alta_operativa' => $id_alta_operativa)
                );
            }
        }
    }

    public function guardarListaAltaOperativaxEscenarios($id_alta_operativa,$lista_escenarios = array())
    {
        if(is_array($lista_escenarios)) {
            foreach ($lista_escenarios as $id_escenario) {
                DB::table('altas_operativasxescenarios')->insert(
                    array('id_escenario' => $id_escenario,
                        'id_alta_operativa' => $id_alta_operativa)
                );
            }
        }
    }

    public static function borrarEscenariosPorIdOlor($id_olor)
    {
        DB::table('oloresxescenarios')->where('id_olor', '=', $id_olor)->delete();
    }

    public static function darListaDeEscenariosXIdAltaOperativa($id_alta_operativa)
    {
        $resultado = DB::table('altas_operativasxescenarios')
            ->join('escenarios', 'escenarios.id', '=', 'altas_operativasxescenarios.id_escenario')
            ->where('id_alta_operativa',$id_alta_operativa)
            ->get(array('escenarios.escenario'));
//        dd($resultado);
        $valor = "";
        foreach($resultado as $r)
        {
            if($valor)
                $valor .= ", ".$r->escenario;
            else
                $valor .= $r->escenario;
        }

        if($valor == "")
            $valor = "No tiene";
        return $valor;

    }

    public static function darListaDeOloresXIdAltaOperativa($id_alta_operativa)
    {
        $resultado = DB::table('altas_operativasxolores')
            ->join('olores', 'olores.id', '=', 'altas_operativasxolores.id_olor')
            ->where('id_alta_operativa',$id_alta_operativa)
            ->get(array('olores.olor'));
//        dd($resultado);
        $valor = "";
        foreach($resultado as $r)
        {
            if($valor)
                $valor .= ", ".$r->olor;
            else
                $valor .= $r->olor;
        }

        if($valor == "")
            $valor = "No tiene";

        return $valor;

    }



    public static function darListadoAltasOperativasDeUnPerro($id_perro)
    {
        $listado = self::where('id_perro',$id_perro)
            ->join('perros','perros.id','=','altas_operativas.id_perro')
            ->join('areas','areas.id','=','altas_operativas.id_area')
            ->join('especialidades','especialidades.id','=','altas_operativas.id_especialidad')
            ->get(array('altas_operativas.id_alta_operativa','perros.nombre','perros.nro_chip','areas.area','especialidades.nombre as especialidad','altas_operativas.fecha_alta','altas_operativas.fecha_vencimiento'));
        foreach($listado as $l)
        {
            $l->fecha_alta = Time::FormatearToNormal($l->fecha_alta);
            $l->fecha_vencimiento = Time::FormatearToNormal($l->fecha_vencimiento);
            $l->escenarios = AltaOperativa::darListaDeEscenariosXIdAltaOperativa($l->id_alta_operativa);
            $l->olores = AltaOperativa::darListaDeOloresXIdAltaOperativa($l->id_alta_operativa);

        }
        return $listado;
    }*/


}