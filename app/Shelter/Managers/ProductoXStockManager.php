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

class ProductoXStockManager extends BaseManager{

    public function getRules()
    {
        return [];
    }

    public function getMessages()
    {
        return [];
    }

    public function prepareData($data)
    {
        if (!$data['stock'])
        {
            $data['stock'] = 0;
        }
        $data['stock_inicial'] = $data['stock'];
        return $data;
    }

    public function save($id = "")
    {
        $productoxstock = new ProductoXStock();
        $repoProductosxStock = new RepoProductoXStock();
        if($id)
            $this->data['id'] = $id;
        else
            $this->data['id'] = $this->getEntity()->id;
        $this->data['nro_registro'] = $repoProductosxStock->darMaximoNroRegistro($this->data['id']);
        $productoxstock->fill($this->data);
        $productoxstock->save();
    }
}