<?php namespace Shelter\Entities;
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 14/03/15
 * Time: 21:40
 */
class ReservaSala extends \Eloquent
{
    protected $table = 'reservas_salas';
    protected $fillable = array('id', 'id_sala','anio','mes','dia','hora_inicio','minuto_inicio','hora_fin','minuto_fin','id_grupo','comentario','id_estado_reserva','id_servicio');

    public function grupo(){
        return $this->hasOne('Shelter\Entities\Grupo','id','id_grupo');
    }

}