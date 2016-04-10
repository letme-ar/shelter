<?php
class Estilo2 extends Eloquent
{
    protected $table = 'estilos';
    protected $fillable = array('id', 'estilo','eliminado');

    public static function darListaParaCombo()
    {
        $estilos = self::where('eliminado',0)->lists('estilo', 'id');
        return $estilos;
    }

    public static function listado()    {
        $results = self::orderBy('eliminado','asc')->get();
        return $results;
    }

    public function isValid($data,$id="")  {

        $rules = array(
            'estilo' => 'required|min:4|max:60|unique:estilos'
        );

        if ($this->exists)
        {
            $rules['estilo'] .= ',estilo,' . $this->id;
        }

        $messages = array(
            'estilo.required' => 'El campo es obligatorio',

        );

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->passes())
        {
            return true;
        }

        $this->errors = $validator->errors();

        return false;
    }

    public function eliminarEstilo($id)
    {
        self::where('id', $id)
            ->update(array('eliminado' => 1));
    }

}

?>