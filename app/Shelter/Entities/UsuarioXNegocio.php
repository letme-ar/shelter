<?php namespace Shelter\Entities;
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 13/03/15
 * Time: 13:11
 */
class UsuarioXNegocio extends \Eloquent
{
    protected $table = 'usuariosxnegocios';
    protected $fillable = array('id', 'id_negocio', 'id_negocio', 'principal');

}