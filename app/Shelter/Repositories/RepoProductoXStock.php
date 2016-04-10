<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 23/03/15
 * Time: 23:25
 */

namespace Shelter\Repositories;
use Shelter\Entities\ProductoXStock;

class RepoProductoXStock extends RepoBase
{
    function getModel()
    {
        // TODO: Implement getModel() method.
        return new ProductoXStock();

    }

    public function nuevoProductoXStock()
    {
        return $this->getModel();
    }

    public function darMaximoNroRegistro($id)
    {
        $registro = $this->where("id",$id)->max("nro_registro");
        if(!$registro)
            return 1;
        else
            return $registro+1;
    }

    public function darRegistrosXId($id)
    {
        return $this->getModel()->where("id",$id)->get(array("nro_registro","stock","stock_inicial","proveedor","precio_costo","precio_venta","comentario","created_at"));
    }

    public function darStockTotal($id)
    {
        return $this->getModel()->where("id",$id)->sum("stock");
    }

    public function darUltimoAgregado($id)
    {
        $max = $this->getModel()->where("id",$id)->max("nro_registro");
        $registro = $this->getModel()->where("id",$id)->where("nro_registro",$max)->get(array("nro_registro","proveedor","stock","precio_costo","precio_venta","comentario","created_at"));
        return $registro[0];

    }

    public function darPrecioActual($id)
    {
        $max = $this->getModel()->where("id",$id)->max("nro_registro");
        $resultado = $this->getModel()->where("id",$id)->where("nro_registro",$max)->get(array("precio_venta"))->first();
        return $resultado->precio_venta;
    }

    public function actualizarStock($id,$stock_vendido)
    {
        $producto = $this->getModel()->where('id',$id)->get();
        foreach($producto as $p)
        {
            if($stock_vendido > 0)
            {
                if($p->stock > 0)
                {
                    $stock = $p->stock;
                    if($stock < $stock_vendido)
                    {
                        $stock_vendido = $stock_vendido - $stock;
                        $this->getModel()->where('id', $id)->where('nro_registro',$p->nro_registro)
                            ->update(array('stock' => 0));
                    }
                    else
                    {
                        $cantidad_actualizada = $p->stock - $stock_vendido;
                        $stock_vendido = 0;
                        $this->getModel()->where('id', $id)->where('nro_registro',$p->nro_registro)
                            ->update(array('stock' => $cantidad_actualizada));
                    }
                }
            }
        }

        /*$nro_registro = $this->getModel()->where('id', $id)->where('stock',">",0)->min("nro_registro");
        $cantidad = $this->getModel()->where('id', $id)->where('nro_registro',$nro_registro)->get(array("stock"));
        $cantidad_actualizada = $cantidad[0]->stock - $stock_vendido;
        $this->getModel()->where('id', $id)->where('nro_registro',$nro_registro)
            ->update(array('stock' => $cantidad_actualizada));*/
    }

    public function devolucionStock($id,$stock_devuelto)
    {
        $producto = $this->getModel()->where('id',$id)->orderBy('nro_registro','desc')->get();
        foreach($producto as $p)
        {
            if($stock_devuelto > 0)
            {
                if($p->stock < $p->stock_inicial)
                {

                    $stock = $p->stock_inicial - $p->stock;
                    if($stock >= $stock_devuelto)
                    {
                        $stock_actualizado = $p->stock + $stock_devuelto;
                        $stock_devuelto = 0;
                        $this->getModel()->where('id', $id)->where('nro_registro',$p->nro_registro)
                            ->update(array('stock' => $stock_actualizado));
                    }
                    else
                    {
                        $cantidad_actualizada = $p->stock_inicial;
                        $stock_devuelto = $stock_devuelto - $stock;
                        $this->getModel()->where('id', $id)->where('nro_registro',$p->nro_registro)
                            ->update(array('stock' => $cantidad_actualizada));
                    }
                }
            }
        }
    }

}