<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 12/12/14
 * Time: 16:36
 */
class HelperEstado
{
    public static function darEstado($estado)
    {
        if($estado == 0)
            return "Activo";
        else if($estado == 1)
            return "Inactivo";
        else
            return "";
    }
}