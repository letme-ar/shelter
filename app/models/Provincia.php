<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 11/12/14
 * Time: 15:34
 */
class Provincia2 extends Eloquent
{
    protected $table = 'provincias';
    protected $fillable = array('id', 'provincia');

    public static function darListaParaCombo()
    {
        $provincias = self::lists('provincia', 'id');
        return $provincias;
    }

    public static function listado()    {
        $results = self::orderBy('id','asc')->get();
        return $results;
    }


}

?>