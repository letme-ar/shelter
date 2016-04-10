<?php
class Contacto2 extends Eloquent
{
    protected $table = 'contactos';
    protected $fillable = array('id', 'id_grupo','id_negocio','nro_integrante','nombrecontacto','telefonocontacto','principal');

    public static function guardar($id_grupo,$nro_integrante,$nombrecontacto,$telefonocontacto,$principal,$id_negocio)
    {
        self::insert(array(
            'id_grupo' => $id_grupo,
            'nro_integrante' => $nro_integrante,
            'nombrecontacto' => $nombrecontacto,
            'telefonocontacto' => $telefonocontacto,
            'principal' => $principal,
            'id_negocio' => $id_negocio

    ));
    }

    public static function listadoPorGrupo($id_grupo,$id_negocio)
    {
        $results = self::where("id_grupo",$id_grupo)->where("id_negocio",$id_negocio)->
        orderBy('nro_integrante','asc')->get();
        return $results;
    }

    public static function eliminarContactosPorGrupo($id_grupo,$id_negocio)
    {
        self::where('id_grupo',$id_grupo)->where('id_negocio',$id_negocio)->delete();
    }

    public static function darContactoPrincipal($id_grupo,$id_negocio)
    {
        $results = self::where("id_grupo",$id_grupo)->where("id_negocio",$id_negocio)->where("principal",1)->get();
        return $results[0]->nombrecontacto. ": ".$results[0]->telefonocontacto;
    }



}

?>