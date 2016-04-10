<?php namespace Shelter\Entities;
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 12/03/15
 * Time: 14:24
 */

class Estilo extends \Eloquent
{
    protected $table = 'estilos';
    protected $fillable = array('id', 'estilo', 'eliminado');
}