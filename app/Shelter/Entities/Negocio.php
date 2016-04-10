<?php namespace Shelter\Entities;
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 12/03/15
 * Time: 15:53
 */
class Negocio extends \Eloquent
{
    protected $table = 'negocios';
    protected $fillable = array('id', 'nombre','direccion','id_localidad','mail','facebook','twitter','web','estado');

}