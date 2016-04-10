<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 06/02/15
 * Time: 12:05
 */
class Sala2 extends Eloquent
{
    protected $table = 'salas';
    protected $fillable = array('id', 'id_negocio','sala','principal');

    public static function guardar($id_negocio,$sala,$principal)
    {
        self::insert(array(
            'id_negocio' => $id_negocio,
            'sala' => $sala,
            'principal' => $principal
        ));
    }

    public static function listadoPorNegocio($id_negocio)
    {
        $results = self::where("id_negocio",$id_negocio)->get();
        return $results;
    }

    public static function eliminarSalaPorNegocio($id_negocio)
    {
        self::where('id_negocio',$id_negocio)->delete();
    }

    public static function darSalasXNegocio($id_negocio)
    {
        return self::where("id_negocio",$id_negocio)->lists("sala","id");
    }

    public static function darSalaActual($id_negocio)
    {
        $res = self::where("id_negocio",$id_negocio)->where("principal",1)->get(array("id"));
        return $res[0]->id;
    }

    public static function actualizarSalaPrincipal($id)
    {
        self::where("id_negocio",Auth::user()->negocioActual()[0]->id_negocio)->update(
            array("principal" => 0)
        );

        self::where("id",$id)->where("id_negocio",Auth::user()->negocioActual()[0]->id_negocio)
            ->update(
            array("principal" => 1)
        );
    }

}

?>