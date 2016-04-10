<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 11/12/14
 * Time: 15:34
 */
class Localidad2 extends Eloquent
{
    protected $table = 'localidades';
    protected $fillable = array('id','cp', 'localidad','id_provincia');

    public static function darListaParaCombo($id_provincia)
    {
        $localidades = self::where("id_provincia",$id_provincia)->lists('localidad', 'id');
        return $localidades;
    }

    public static function listado()    {
        $results = self::orderBy('id','asc')->get();
        return $results;
    }

    public static function darProvincia($id)
    {
        $results = self::where("id",$id)->get(array("id_provincia"));
        if(count($results) > 0)
            return $results[0]->id_provincia;
        else
            return "";


    }


}

?>