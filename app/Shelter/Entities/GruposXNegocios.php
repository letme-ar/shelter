<?php namespace Shelter\Entities;
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 14/03/15
 * Time: 19:28
 */
class GruposXNegocios extends \Eloquent
{
    protected $table = 'gruposxnegocios';
    protected $fillable = array('id', 'id_grupo','id_negocio');
}