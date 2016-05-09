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
    protected $fillable = array('id', 'id_sala','anio','mes','dia','id_horario_inicio','id_horario_fin','id_grupo','comentario','id_estado_reserva','id_servicio');

    public function grupo(){
        return $this->hasOne('Shelter\Entities\Grupo','id','id_grupo');
    }

    public function horario_inicio(){
        return $this->hasOne('Shelter\Entities\Horario','id','id_horario_inicio');
    }

    public function horario_fin(){
        return $this->hasOne('Shelter\Entities\Horario','id','id_horario_fin');
    }


}