<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 12/12/14
 * Time: 10:37
 */
use Shelter\Entities\Telefono;
class HelperTelefono
{
    public static function agregarTelefono()
    {
        $numtelefono = $_POST['telefono'];
        $telefono = new Telefono();
        $telefono->telefono = $numtelefono;

        $lista = Session::get("telefonos");
        $lista = unserialize(serialize($lista));
        if(count($lista)>0)
        {
            $ban = true;
            foreach($lista as $l)
            {
                if($l->telefono == $numtelefono)
                    $ban = false;
            }
            if($ban)
                Session::push("telefonos",$telefono);

        }
        else
        {
            $telefono->principal = 1;
            Session::push("telefonos",$telefono);
        }

        $lista = Session::get("telefonos");
        $lista = unserialize(serialize($lista));
        return HelperTelefono::listadoTelefonos($lista);
    }

    public static function listadoTelefonos($telefonos)
    {
        if(count($telefonos)>0)
            return View::make("telefonos/listadoTelefonos",compact("telefonos"));
    }

    public static function borrarTelefono()
    {
        $telefono = $_POST['telefono'];
        $lista = Session::get("telefonos");
        $lista = unserialize(serialize($lista));

        $lista_nueva = array();
        foreach($lista as $l)
        {
            if($l->telefono != $telefono)
                array_push($lista_nueva,$l);
      }
        Session::put('telefonos',$lista_nueva);
        $lista = Session::get("telefonos");
        $lista = unserialize(serialize($lista));
        return HelperTelefono::listadoTelefonos($lista,true);
    }
}
?>