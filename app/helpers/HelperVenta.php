<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 05/04/15
 * Time: 18:41
 */
use Shelter\Entities\Venta;
use Shelter\Repositories\RepoProducto;
use Shelter\Repositories\RepoProductoXStock;
class HelperVenta
{
    public static function agregarVenta()
    {
        $repoProductoXStock = new RepoProductoXStock();
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];

        $repoProducto= new RepoProducto();
        $producto = $repoProducto->darProductoPorDescripcion($nombre);

        $venta = new Venta();
        $venta->cantidad = $cantidad;
        $venta->producto = $producto;
        $venta->id_producto = $venta->producto->id;
        $venta->precio_unitario = $repoProductoXStock->darPrecioActual($producto->id);


        $lista = Session::get("ventas");
        $lista = unserialize(serialize($lista));

        if(count($lista)>0)
        {
            $venta->nro_registro = count($lista)+1;
            Session::push("ventas",$venta);

        }
        else
        {
            $venta->nro_registro = 1;
            Session::push("ventas",$venta);
        }

        $lista = Session::get("ventas");
        $lista = unserialize(serialize($lista));
        $precio_total = HelperVenta::darPrecioTotal($lista);
        return HelperVenta::listadoVentas($lista,$precio_total);


    }

    public static function darPrecioTotal($ventas)
    {
        $val = 0;
        foreach ($ventas as $v)
        {
            $val += $v->cantidad * $v->precio_unitario;
        }
        return $val;

    }

    public static function listadoVentas($lista,$precio_total,$noMostrar="")
    {
//        dd($noMostrar);
        if(count($lista)>0)
            return View::make("ventas/listaProductosSeleccionados",compact("lista","precio_total","noMostrar"));
    }

    public static function eliminarVenta()
    {
        $nro_registro = $_POST['nro_registro'];
        $lista = Session::get("ventas");
        $lista = unserialize(serialize($lista));

        $lista_nueva = array();
        $nro_reg = 1;
        foreach($lista as $l)
        {
            if($l->nro_registro != $nro_registro)
            {
                $l->nro_registro = $nro_reg;
                array_push($lista_nueva,$l);
                $nro_reg++;
            }

        }
        Session::put('ventas',$lista_nueva);
        $lista = Session::get("ventas");
        $lista = unserialize(serialize($lista));
        $precio_total = HelperVenta::darPrecioTotal($lista);
        return HelperVenta::listadoVentas($lista,$precio_total);
    }
}