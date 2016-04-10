<?php namespace Shelter\Entities;
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 13/03/15
 * Time: 10:26
 */
class Telefono extends \Eloquent
{
    protected $table = 'telefonos';
    protected $fillable = array('id', 'id_negocio', 'telefono', 'principal');
}