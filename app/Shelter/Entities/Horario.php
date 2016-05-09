<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 07/05/16
 * Time: 20:38
 */

namespace Shelter\Entities;


class Horario extends \Eloquent
{
    protected $table = 'horarios';
    protected $fillable = array('id','horario');

}