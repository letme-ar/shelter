<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 23/03/15
 * Time: 23:23
 */

namespace Shelter\Entities;
use Shelter\Components\FunctionsSpecials;

class ProductoXStock extends \Eloquent {

    protected $table = 'productosxstock';
    protected $fillable = array('id','nro_registro','proveedor','stock','stock_inicial','precio_costo','precio_venta','comentario');


    public function getCreatedAtTitleAttribute()
    {
//        $functionsSpecials = new FunctionsSpecials();
        return date_format($this->created_at, "d/m/Y");
    }

} 