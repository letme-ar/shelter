<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 06/02/15
 * Time: 12:04
 */
use Shelter\Entities\Sala;
class HelperSala
{
    public static function agregarSala()
    {
//        dd($_POST);
        $nombre = $_POST['sala'];
        $sala = new Sala();
        $sala->sala = $nombre;

        $lista = Session::get("salas");
        $lista = unserialize(serialize($lista));
//        echo "<pre>";
//        dd($lista);
        if(count($lista)>0)
        {
            $ban = true;
            foreach($lista as $l)
            {
                if($l->sala == $sala)
                    $ban = false;

            }
            if($ban)
            {
                Session::push("salas",$sala);
            }

        }
        else
        {
            $sala->principal = 1;
            Session::push("salas",$sala);
        }

        $lista = Session::get("salas");
        $lista = unserialize(serialize($lista));
        return HelperSala::listadoSalas($lista);
    }

    public static function listadoSalas($salas)
    {
        if(count($salas)>0)
            return View::make("salas/listadoSalas",compact("salas"));
    }

    public static function borrarSala()
    {
        $sala = $_POST['sala'];
        $lista = Session::get("salas");
        $lista = unserialize(serialize($lista));

        $lista_nueva = array();
        foreach($lista as $l)
        {
//            echo $id;
            if($l->sala != $sala)
                array_push($lista_nueva,$l);

        }
        Session::put('salas',$lista_nueva);
        $lista = Session::get("salas");
        $lista = unserialize(serialize($lista));
//        echo "<pre>";
//            print_r($lista);
//        echo "</pre>";
//        die();
        return HelperSala::listadoSalas($lista,true);
    }
}
?>