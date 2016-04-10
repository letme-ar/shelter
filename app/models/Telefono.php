<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 12/12/14
 * Time: 10:30
 */
class Telefono2 extends Eloquent
{
    protected $table = 'telefonos';
    protected $fillable = array('id', 'id_negocio','telefono','principal');

    public static function guardar($id_negocio,$telefono,$principal)
    {
        self::insert(array(
            'id_negocio' => $id_negocio,
            'telefono' => $telefono,
            'principal' => $principal
        ));
    }

    public static function listadoPorNegocio($id_negocio)
    {
        $results = self::where("id_negocio",$id_negocio)->
        get();
        return $results;
    }

    public static function eliminarTelefonoPorNegocio($id_negocio)
    {
        self::where('id_negocio',$id_negocio)->delete();
    }



}

?>