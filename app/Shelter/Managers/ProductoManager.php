<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 21/03/15
 * Time: 17:29
 */

namespace Shelter\Managers;
use Shelter\Entities\ProductoXStock;
use Shelter\Repositories\RepoProductoXStock;

class ProductoManager extends BaseManager{

    public function getRules()
    {
        return [
            'nombre' => 'required|min:3|max:100'.$this->entity->id,
            'stock' => 'numeric'.$this->entity->id,
            'precio_costo' => 'sometimes|required|numeric'.$this->entity->id,
            'precio_venta' => 'sometimes|required|numeric'.$this->entity->id
        ];
    }

    public function getMessages()
    {
        return [
            'precio_venta.required' => 'El campo precio de venta es requerido',
            'precio_costo.required' => 'El campo precio de costo es requerido',
            'precio_venta.numeric' => 'El campo precio de venta debe ser numérico',
            'precio_costo.numeric' => 'El campo precio de costo debe ser numérico'
        ];
    }

    public function isValid()
    {
        $rules        = $this->getRules();
        $messages     = $this->getMessages();
        $validation   = \Validator::make($this->data,$rules,$messages);
        $isValid      = $validation->passes();
        $this->errors = $validation->errors();

//        dd($isValid);
        if(!$isValid)
            return $this->mostrarErrores($isValid);
        else
        {
            if($this->data['stock'] < 0)
            {
                if($this->data['comentario'] == "")
                    return "Debe ingresar un comentario";

            }
            else if(!isset($this->data['id']))
                if(isset($this->data['stock']))
                    if($this->data['stock'] <= 0)
                        return "El stock debe ser positivo";
//            if(!isset($this->data['id']) && $this->data['stock'] <= 0)
//                return "El stock debe ser positivo";
            else if(isset($this->data['id']))
            {
                $repoProductosxStock = new RepoProductoXStock();
                $stock_total = $repoProductosxStock->darStockTotal($this->data['id']) + $this->data['stock'];
                if($stock_total < 0)
                    return "El stock actual es menor al stock que desea quitar";
            }
            else
                return $this->mostrarErrores($isValid);

        }
    }

    public function prepareData($data)
    {
        if (isset($data['stock']) && !$data['stock'])
        {
            $data['stock'] = 0;
        }

        $data['id_negocio'] = \Auth::user()->negocioActual()[0]->id_negocio;

        return $data;
    }

    public function save()
    {
        parent::save();
        if(isset($this->data['precio_venta']))
        {
            $productoxstock = new ProductoXStock();
            $repoProductosxStock = new RepoProductoXStock();
            $this->data['id'] = $this->getEntity()->id;
            $this->data['nro_registro'] = $repoProductosxStock->darMaximoNroRegistro($this->data['id']);
            $productoxstock->fill($this->data);
            $productoxstock->save();
        }
    }
}