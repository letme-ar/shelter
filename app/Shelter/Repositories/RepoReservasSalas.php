<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 14/03/15
 * Time: 21:42
 */
namespace Shelter\Repositories;
use Shelter\Entities\ReservaSala;

class RepoReservasSalas extends RepoBase
{

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new ReservaSala();

    }

    public function nuevaReservaSala()
    {
        return $this->getModel();
    }

    public function darReservaXSala($id_sala,$id_negocio_principal)
    {
        $datos = $this->getModel()->where("id_sala",$id_sala)
            ->whereIn('id_estado_reserva', array(1, 2,4,5))
            ->join("grupos","reservas_salas.id_grupo","=","grupos.id")
            ->leftJoin('contactos', function ($join) use ($id_negocio_principal) {
                $join->on('grupos.id', '=', 'contactos.id_grupo')
                    ->where('contactos.principal', '=', 1)
                    ->where('contactos.id_negocio',"=",$id_negocio_principal);
            })
            ->get(array('reservas_salas.id', 'reservas_salas.id_sala','reservas_salas.anio','reservas_salas.mes','reservas_salas.dia','reservas_salas.hora_inicio','reservas_salas.minuto_inicio','reservas_salas.hora_fin','reservas_salas.minuto_fin','reservas_salas.id_grupo','reservas_salas.id_estado_reserva','reservas_salas.id_servicio','reservas_salas.comentario','grupos.nombre',\DB::raw('CONCAT(contactos.nombrecontacto, ": ", contactos.telefonocontacto) AS contacto')));
        foreach($datos as $d)
        {
            if($d->id_estado_reserva != 1 && $d->id_estado_reserva != 2)
                $d->readOnly = true;
            else
                $d->readOnly = false;
        }
        return $datos;
    }

    public function validarReprogramacion($reserva_original, $reserva_nueva)
    {
        if($reserva_original->anio == $reserva_nueva['anio'] && $reserva_original->mes == $reserva_nueva['mes'] && $reserva_original->dia == $reserva_nueva['dia'] && $reserva_original->hora_inicio == $reserva_nueva['hora_inicio'] && $reserva_original->minuto_inicio == $reserva_nueva['minuto_inicio'] && $reserva_original->hora_fin == $reserva_nueva['hora_fin'] && $reserva_original->minuto_fin == $reserva_nueva['minuto_fin'])
            return false;
        else
            return true;
    }

    public function darListaVencidas($id_sala)
    {
        $fecha_actual = date("Y-n-j");
        $hora_actual = date("H:i");
        $datos = $this->getModel()->where("id_sala",$id_sala)
                    ->whereIn("id_estado_reserva",array(1,2))
                    ->whereRaw("concat(anio,'-',mes,'-',dia) < '$fecha_actual'")
            ->orWhere(function($query) use ($id_sala,$fecha_actual,$hora_actual)
            {
                $query->WhereRaw("id in (select id from reservas_salas where id_sala = $id_sala and id_estado_reserva in (1,2) and concat(anio,'-',mes,'-',dia) <= '$fecha_actual' and concat(hora_fin,':',minuto_fin) <= '$hora_actual')");
            })
            ->get();
        return $datos;
    }

    public function darIdsVencidas($id_sala)
    {
        $fecha_actual = date("Y-n-j");
        $hora_actual = date("H:i");
        $datos = $this->getModel()
            ->where("id_sala",$id_sala)
            ->whereIn("id_estado_reserva",array(1,2))
            ->whereRaw("concat(anio,'-',mes,'-',dia) < '$fecha_actual'")
            ->orWhere(function($query) use ($id_sala,$fecha_actual,$hora_actual)
            {
                $query->WhereRaw("id in (select id from reservas_salas where id_sala = $id_sala and id_estado_reserva in (1,2) and concat(anio,'-',mes,'-',dia) <= '$fecha_actual' and concat(hora_fin,':',minuto_fin) <= '$hora_actual')");
            })
            ->lists('id');
        return $datos;
    }

    public function actualizarVencidas($id,$id_estado)
    {
        $this->getModel()->where('id', $id)
            ->update(array('id_estado_reserva' => $id_estado));
    }

}