<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 11/12/14
 * Time: 17:22
 */
use Shelter\Entities\Contacto;
class HelperContacto
{
    public static function agregarContacto()
    {
        $nombre = $_POST['nombrecontacto'];
        $telefono = $_POST['telefonocontacto'];
        $contacto = new Contacto();
        $contacto->nombrecontacto = $nombre;
        $contacto->telefonocontacto = $telefono;

        $lista = Session::get("contactos");
        $lista = unserialize(serialize($lista));

//        echo "<pre>";
//        dd($lista);
        if(count($lista)>0)
        {
            $ban = true;
            $contacto->nro_integrante = count($lista)+1;
            foreach($lista as $l)
            {
                if($l->nombrecontacto == $nombre && $l->telefonocontacto == $telefono)
                    $ban = false;

            }
            if($ban)
            {
                Session::push("contactos",$contacto);
            }

        }
        else
        {
            $contacto->nro_integrante = 1;
            $contacto->principal = 1;
            Session::push("contactos",$contacto);
        }

        $lista = Session::get("contactos");
        $lista = unserialize(serialize($lista));
//        echo "<pre>";
//            print_r($lista);
//        echo "</pre>";
        return HelperContacto::listadoContactos($lista,true);
    }

    public static function listadoContactos($contactos,$permitir_modificar)
    {
        if(count($contactos)>0)
            return View::make("contactos/listadoContactos",compact("contactos","permitir_modificar"));
    }

    public static function borrarContacto()
    {
        $id = $_POST['id'];
        $lista = Session::get("contactos");
        $lista = unserialize(serialize($lista));

        $lista_nueva = array();
        foreach($lista as $l)
        {
//            echo $id;
            if($l->nro_integrante != $id)
                array_push($lista_nueva,$l);

        }
        Session::put('contactos',$lista_nueva);
        $lista = Session::get("contactos");
        $lista = unserialize(serialize($lista));
//        echo "<pre>";
//            print_r($lista);
//        echo "</pre>";
        return HelperContacto::listadoContactos($lista,true);
    }
}
?>