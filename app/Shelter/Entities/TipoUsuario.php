<?php namespace Shelter\Entities;
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 13/03/15
 * Time: 18:38
 */
class TipoUsuario extends \Eloquent
{
    protected $table = 'tipos_usuarios';
    protected $fillable = array('id', 'tipo_usuario', 'activo');
}