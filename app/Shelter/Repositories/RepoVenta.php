<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 04/04/15
 * Time: 19:25
 */

namespace Shelter\Repositories;


use Shelter\Entities\Venta;

class RepoVenta extends RepoBase {

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new Venta();

    }

    public function nuevaVenta()
    {
        return $this->getModel();
    }

    public function darUltimoId()
    {
        $max = $this->getModel()->max("id");
        return $max + 1;
    }

    public function darVentasPorNegocio($id_negocio)
    {
        return $this->getModel()->where("id_negocio",$id_negocio)->where('eliminado',0)
            ->groupBy('id')
            ->orderBy('created_at')
            ->get(array('id','id_grupo','created_at',\DB::raw('SUM(precio_unitario * cantidad) as precio_unitario')));
    }

    public function darCantidadVendidaDeUnProducto($id_producto)
    {
        return $this->getModel()->where("id_producto",$id_producto)->where('eliminado',0)->sum("cantidad");
    }

    public function darVenta($id)
    {
        return $this->getModel()->where('id',$id)->get();
    }

    public function anularVenta($id)
    {
        $this->getModel()->where('id',$id)->update(['eliminado' => 1]);

    }





} 