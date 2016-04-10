<?php namespace Shelter\Entities;
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 27/06/15
 * Time: 15:00
 */

class ReservaEstado extends \Eloquent
{
    protected $table = 'reservas_estados';
    protected $fillable = array('id', 'estado');
}