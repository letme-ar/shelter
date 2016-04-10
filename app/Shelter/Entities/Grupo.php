<?php namespace Shelter\Entities;
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 14/03/15
 * Time: 19:47
 */
class Grupo extends \Eloquent
{
    protected $table = 'grupos';
    protected $fillable = array('id', 'nombre','id_estilo','web','facebook','twitter','integrantes','eliminado','id_usuario_creador');
    public $errors;
}