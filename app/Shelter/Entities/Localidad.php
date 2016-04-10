<?php namespace Shelter\Entities;
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 13/03/15
 * Time: 12:16
 */
class Localidad extends \Eloquent
{
    protected $table = 'localidades';
    protected $fillable = array('id', 'cp', 'localidad', 'id_provincia');

    public function getProvincia(){
        return $this->hasOne('Shelter\Entities\Provincia','id','id_provincia');
    }
}