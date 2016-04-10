<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 07/02/15
 * Time: 19:43
 */
class ReservaSalas2 extends Eloquent
{
    protected $table = 'reservas_salas';
    protected $fillable = array('id', 'id_sala','anio','mes','dia','hora_inicio','minuto_inicio','hora_fin','minuto_fin','id_grupo','comentario');

    public static function darReservaXSala($id_sala)
    {
        $datos = self::where("id_sala",$id_sala)
            ->join("grupos","reservas_salas.id_grupo","=","grupos.id")
            ->leftJoin('contactos', function ($join) {
                $join->on('grupos.id', '=', 'contactos.id_grupo')
                    ->where('contactos.principal', '=', 1)
                    ->where('contactos.id_negocio',"=",Auth::user()->negocioActual()[0]->id_negocio);
            })
            ->get(array('reservas_salas.id', 'reservas_salas.id_sala','reservas_salas.anio','reservas_salas.mes','reservas_salas.dia','reservas_salas.hora_inicio','reservas_salas.minuto_inicio','reservas_salas.hora_fin','reservas_salas.minuto_fin','reservas_salas.id_grupo','reservas_salas.comentario','grupos.nombre',DB::raw('CONCAT(contactos.nombrecontacto, ": ", contactos.telefonocontacto) AS contacto')));

        return $datos;
    }



}