<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 21/03/15
 * Time: 21:22
 */

namespace Shelter\Components;


class FunctionsSpecials
{
    public function DateMysqlToNormal($date)
    {
        if($date)
        {
            $fecha = \DateTime::createFromFormat('Y-m-d', $date);
            return $fecha->format('d/m/Y');
        }
    }

    public function TimestampMysqlToNormal($date)
    {
        if($date)
        {
            $fecha = \DateTime::createFromFormat('Y-m-d H:i:s', $date);
            return $fecha->format('d/m/Y');
        }
    }



    public function DateNormalToMysqo($date)
    {
        if($date)
        {
            $fecha = \DateTime::createFromFormat('d/m/Y', $date);
            return $fecha->format('Y-m-d');
        }
    }

    public function darListaHorarios()
    {
        $array = array('' => 'Seleccione');
        for($hora = 0; $hora <= 23; $hora++ )
        {
            for ($minutos = 0; $minutos < 60; $minutos = $minutos + 30)
            {
                array_push($array,str_pad($hora,2,"0",STR_PAD_LEFT).":".str_pad($minutos,2,"0",STR_PAD_LEFT)." hs");
            }
        }
        array_push($array,"24:00 hs");
        return $array;
    }

    public function darListaHorariosInicio()
    {
        $lista = $this->darListaHorarios();
        $array = array('' => 'Seleccione');
        for($i = 0;$i < count($lista) - 2;$i++)
        {
            $array[$i] = $lista[$i];
        }
        return $array;
    }

    public function darHorarioPorId($id)
    {
        $lista = $this->darListaHorarios();
        return substr($lista[$id], 0, 5);

    }

    public function darComboDatosParaComboEnd($id_start)
    {
        $lista = $this->darListaHorarios();
        $array = array('' => 'Seleccione');
        for($i = $id_start + 1;$i < count($lista) - 1;$i++)
        {
            $array[$i] = $lista[$i];
        }
        return $array;
    }

    public function completarCerosCalendario($val)
    {
        return str_pad($val,2,"0",STR_PAD_LEFT);

    }


} 