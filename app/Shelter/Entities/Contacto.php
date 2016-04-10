<?php namespace Shelter\Entities;
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 14/03/15
 * Time: 21:19
 */
class Contacto extends \Eloquent
{
    protected $table = 'contactos';
    protected $fillable = array('id', 'id_grupo','id_negocio','nro_integrante','nombrecontacto','telefonocontacto','principal');
}