<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 21/03/15
 * Time: 20:42
 */

namespace Shelter\Entities;
use Shelter\Components\FunctionsSpecials;

class Servicio extends Insumo
{
    protected $table = 'servicios';
    protected $functionsSpecials;

    public function __construct()
    {
        array_push($this->fillable,'vigencia_desde');
        array_push($this->fillable,'vigencia_hasta');
        array_push($this->fillable,'precio_venta');
        $this->functionsSpecials = new FunctionsSpecials();
    }

    public function getVigenciaDesdeTitleAttribute()
    {
        if($this->vigencia_desde == "0000-00-00")
            return "00/00/0000";
        else
            return $this->functionsSpecials->DateMysqlToNormal($this->vigencia_desde);
    }

    public function getVigenciaHastaTitleAttribute()
    {
        if($this->vigencia_hasta == "0000-00-00")
            return "00/00/0000";
        else
            return $this->functionsSpecials->DateMysqlToNormal($this->vigencia_hasta);
    }

} 