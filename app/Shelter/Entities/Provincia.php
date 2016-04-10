<?php namespace Shelter\Entities;
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 13/03/15
 * Time: 12:08
 */
class Provincia extends \Eloquent
{
    protected $table = 'provincias';
    protected $fillable = array('id', 'provincia');
}
