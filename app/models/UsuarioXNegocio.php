<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 25/12/14
 * Time: 21:06
 */
class UsuarioXNegocio2 extends Eloquent
{
    protected $table = 'usuariosxnegocios';
    protected $fillable = array('id', 'id_negocio','id_negocio','principal');

    /*public static function validarGrupoXNegocio($id_grupo,$id_negocio)
    {
        $resultado = self::where('id_grupo',$id_grupo)
            ->where('id_negocio',$id_negocio)->get();
        if(count($resultado) > 0)
            return false;
        else
            return true;
    }


    public function estilo(){
        return $this->hasOne('Estilo','id','id_estilo');
    }*/

    public static function tieneNegocioPrincipal($id_usuario)
    {
        $resultado = self::where("id_usuario",$id_usuario)->where("principal",1)->get(array("id"));
        if(count($resultado) > 0)
            return true;
        else
            return false;
    }

    public static function guardarListaNegocios($id_usuario,$lista_negocios)
    {
        if(is_array($lista_negocios)) {
            $ban = true;
            foreach ($lista_negocios as $id_negocio) {
                if($ban)
                {
                    self::insert(array(
                        'id_negocio' => $id_negocio,
                        'id_usuario' => $id_usuario,
                        'principal' => 1
                    ));
                    $ban = 0;
                }
                else
                {
                    self::insert(array(
                        'id_negocio' => $id_negocio,
                        'id_usuario' => $id_usuario,
                        'principal' => 0
                    ));
                }
            }
        }
    }

    public static function guardarListaUsuarios($id_negocio,$lista_usuarios)
    {
        if(is_array($lista_usuarios)) {
            $ban = true;
            foreach ($lista_usuarios as $id_usuario)
            {
                if(!UsuarioXNegocio::tieneNegocioPrincipal($id_usuario))
                {
                    self::insert(array(
                        'id_negocio' => $id_negocio,
                        'id_usuario' => $id_usuario,
                        'principal' => 1
                    ));
                    $ban = false;
                }
                else
                {
                    self::insert(array(
                        'id_negocio' => $id_negocio,
                        'id_usuario' => $id_usuario,
                        'principal' => 0
                    ));

                }
            }
        }
    }


    public static function darNegociosSeleccionadosPorUsuario($id_usuario)
    {
        $lista = self::orderBy('usuariosxnegocios.principal','desc')->
            join('negocios', 'negocios.id', '=', 'usuariosxnegocios.id_negocio')->
            where('negocios.estado',0)->
            where('usuariosxnegocios.id_usuario',$id_usuario)->
            get(array('negocios.id','negocios.nombre','negocios.estado','usuariosxnegocios.principal'));
        $array = array();
        foreach($lista as $l)
        {
            array_push($array,$l);
        }
        return $array;
    }

    public static function darUsuariosSeleccionadosPorNegocio($id_negocio)
    {
        $lista = self::orderBy('users.username','asc')->
            join('users', 'users.id', '=', 'usuariosxnegocios.id_usuario')->
            where('users.estado',0)->
            where('usuariosxnegocios.id_negocio',$id_negocio)->
            get(array('users.id','users.username','users.estado'));
        $array = array();
        foreach($lista as $l)
        {
            array_push($array,$l);
        }
        return $array;
    }

    public static function eliminarNegociosPorUsuario($id_usuario)
    {
        self::where('id_usuario',$id_usuario)->delete();
    }

    public static function eliminarUsuariosPorNegocio($id_negocio)
    {
        self::where('id_negocio',$id_negocio)->delete();
    }

    public static function actualizarNegocioAdministrado($id_usuario,$id_negocio)
    {
        self::where("id_usuario",$id_usuario)->update(
            array("principal" => 0)
        );
        self::where("id_usuario",$id_usuario)->where("id_negocio",$id_negocio)->update(
            array("principal" => 1)
        );

    }

    public static function darNegocioActual($id_usuario)
    {
        return self::where("id_usuario",$id_usuario)->where("principal",1)->get(array("id_negocio"));

    }


}