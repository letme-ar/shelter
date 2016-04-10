<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 21/03/15
 * Time: 16:39
 */

namespace Shelter\Entities;


abstract class Insumo extends \Eloquent {

    protected $fillable = array('id','id_negocio', 'nombre');

} 