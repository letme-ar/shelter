<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 21/03/15
 * Time: 17:02
 */
namespace Shelter\Repositories;
use Shelter\Entities\Producto;

class RepoProducto extends RepoBase
{

    function getModel()
    {
        // TODO: Implement getModel() method.
        return new Producto();

    }

    public function nuevoProducto()
    {
        return $this->getModel();
    }

    public function darProductosPorNegocio($id_negocio)
    {
        $resultados = $this->where("id_negocio",$id_negocio)->all();
        $repoProductosxStock = new RepoProductoXStock();
        foreach($resultados as $r)
        {
            $r->stock_total = $repoProductosxStock->darStockTotal($r->id);
        }
        return $resultados;
    }

    public function darProductosPorDescripcion($producto,$id_negocio_actual,$seleccionados)
    {
        $seleccionados = explode(",",$seleccionados);
        $resultados = $this->getModel()->whereNotIn('id', $seleccionados)->where("id_negocio",$id_negocio_actual)->where("nombre","like","%$producto%")->get();
//        $repoProductosxStock = new RepoProductoXStock();
        if(count($resultados) > 0)
        {
            $array = array();
            foreach ($resultados as $r)
            {
                array_push($array,$r->nombre);
            }
            return $array;
        }
        else
            return array();    }

    public function buscarProductosPorNombre($nombre)
    {
        $resultado = $this->getModel()->where('nombre','like','%'.$nombre.'%')->get();
        if(count($resultado) > 0)
        {
            $array = array();
            foreach ($resultado as $r)
            {
                array_push($array,$r->nombre);
            }
            return $array;
        }
        else
            return array();
    }

    public function darProductoPorDescripcion($nombre)
    {
        return $this->getModel()->where("nombre",$nombre)->first();

    }


}
