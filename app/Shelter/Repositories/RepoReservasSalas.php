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
            ->join("horarios as hi","reservas_salas.id_horario_inicio","=","hi.id")
            ->join("horarios as hf","reservas_salas.id_horario_fin","=","hf.id")
            ->leftJoin('contactos', function ($join) use ($id_negocio_principal) {
                $join->on('grupos.id', '=', 'contactos.id_grupo')
                    ->where('contactos.principal', '=', 1)
                    ->where('contactos.id_negocio',"=",$id_negocio_principal);
            })
            ->get(array('reservas_salas.id', 'reservas_salas.id_sala','hi.horario as horario_inicio','hf.horario as horario_fin','reservas_salas.anio','reservas_salas.mes','reservas_salas.dia','reservas_salas.id_horario_inicio','reservas_salas.id_horario_fin','reservas_salas.id_grupo','reservas_salas.id_estado_reserva','reservas_salas.id_servicio','reservas_salas.comentario','grupos.nombre',\DB::raw('CONCAT(contactos.nombrecontacto, ": ", contactos.telefonocontacto) AS contacto')));
        foreach($datos as $d)
        {
            $horario_inicio = explode(":",$d->horario_inicio);
            $d->hora_inicio = $horario_inicio[0];
            $d->minuto_inicio = $horario_inicio[1];

            $horario_fin = explode(":",$d->horario_fin);
            $d->hora_fin = $horario_fin[0];
            $d->minuto_fin = $horario_fin[1];

            if($d->id_estado_reserva != 1 && $d->id_estado_reserva != 2)
                $d->readOnly = true;
            else
                $d->readOnly = false;
        }
        return $datos;
    }

    public function validarReprogramacion($reserva_original, $reserva_nueva,$id_horario_inicio,$id_horario_fin)
    {
        if($reserva_original->anio == $reserva_nueva['anio'] && $reserva_original->mes == $reserva_nueva['mes'] && $reserva_original->dia == $reserva_nueva['dia'] && $reserva_original->id_horario_inicio == $id_horario_inicio && $reserva_original->id_horario_fin == $id_horario_fin)
            return false;
        else
            return true;
    }

    public function darListaVencidas($id_sala,$id_hora_actual)
    {
        $fecha_actual = date("Y-n-j");
        $datos = $this->getModel()->where("id_sala",$id_sala)
                    ->whereIn("id_estado_reserva",array(1,2))
                    ->whereRaw("concat(anio,'-',mes,'-',dia) < '$fecha_actual'")
            ->orWhere(function($query) use ($id_sala,$fecha_actual,$id_hora_actual)
            {
                $query->WhereRaw("id in (select id from reservas_salas where id_sala = $id_sala and id_estado_reserva in (1,2) and concat(anio,'-',mes,'-',dia) <= '$fecha_actual' and id_horario_fin <= $id_hora_actual)");
            })
            ->get();
        return $datos;
    }

    public function darIdsVencidas($id_sala,$id_hora_actual)
    {
        $fecha_actual = date("Y-n-j");
        $datos = $this->getModel()
            ->where("id_sala",$id_sala)
            ->whereIn("id_estado_reserva",array(1,2))
            ->whereRaw("concat(anio,'-',mes,'-',dia) < '$fecha_actual'")
            ->orWhere(function($query) use ($id_sala,$fecha_actual,$id_hora_actual)
            {
                $query->WhereRaw("id in (select id from reservas_salas where id_sala = $id_sala and id_estado_reserva in (1,2) and concat(anio,'-',mes,'-',dia) <= '$fecha_actual' and id_horario_fin <= $id_hora_actual)");
            })
            ->lists('id');
        return $datos;
    }

    public function actualizarVencidas($id,$id_estado)
    {
        $this->getModel()->where('id', $id)
            ->update(array('id_estado_reserva' => $id_estado));
    }

    public function validarSuperposicion($fecha, $id_sala_actual, $id_horario_inicio, $id_horario_fin)
    {
        $fecha = explode("/",$fecha);
        $dia = $fecha[0];
        $mes = $fecha[1];
        $anio = $fecha[2];

        if($this->getModel()
            ->where("dia",$dia)
            ->where("mes",$mes)
            ->where("anio",$anio)
            ->whereIn("id_estado_reserva",[1,2])
            ->where("id_sala",$id_sala_actual)
            ->whereRaw("((id_horario_inicio >= $id_horario_inicio and id_horario_inicio < $id_horario_fin)
                            or (id_horario_fin > $id_horario_inicio and id_horario_fin <= $id_horario_fin))")
            ->get(['id'])->first())
            return true;
        else
            return false;

    }

}