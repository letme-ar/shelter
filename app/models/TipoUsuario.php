<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 16/12/14
 * Time: 15:42
 */
class TipoUsuario2 extends Eloquent
{
    protected $table = 'tipos_usuarios';
    protected $fillable = array('id', 'tipo_usuario', 'activo');

    public static function darListaParaCombo()
    {
        $estilos = self::where('activo', 0)->lists('tipo_usuario', 'id');
        return $estilos;
    }

    public static function listado()
    {
        $results = self::orderBy('activo', 'asc')->get();
        return $results;
    }
}