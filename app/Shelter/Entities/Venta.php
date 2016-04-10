<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 04/04/15
 * Time: 19:22
 */

namespace Shelter\Entities;


use Shelter\Components\FunctionsSpecials;

class Venta extends \Eloquent{

    protected $table = 'ventas';
    protected $fillable = array('id', 'nro_registro','id_negocio','id_grupo','id_producto','cantidad','precio_unitario','eliminado');

    public function producto(){
        return $this->hasOne('Shelter\Entities\Producto','id','id_producto');
    }

    public function grupo(){
        return $this->hasOne('Shelter\Entities\Grupo','id','id_grupo');
    }

    public function getCreatedAtTitleAttribute()
    {
        $functionsSpecials = new FunctionsSpecials();
        return $functionsSpecials->TimestampMysqlToNormal($this->created_at);
    }

} 