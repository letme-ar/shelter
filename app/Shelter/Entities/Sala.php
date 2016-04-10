<?php namespace Shelter\Entities;
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 13/03/15
 * Time: 10:46
 */
class Sala extends \Eloquent
{
    protected $table = 'salas';
    protected $fillable = array('id', 'id_negocio', 'sala', 'principal');
}