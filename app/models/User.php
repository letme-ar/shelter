<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Shelter\Repositories\RepoUsuarioXNegocio;
class User2 extends Eloquent implements UserInterface, RemindableInterface {



	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
    protected $fillable = array('id', 'username','password','nombre','apellido','tipo_usuario','estado');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return "remember_token";
    }

    public function getReminderEmail()
    {
        return $this->email;
    }

    public function negocio(){

        return $this->hasOne('Negocio','id_usuario','id');
    }

    public function isValid($data,$id="")  {

        $rules = array(
            'nombre' => 'required|min:4|max:50',
            'apellido' => 'required|min:3|max:50',
            'username' => 'required|min:4|max:50',
            'tipo_usuario' => 'required',
            'negocios_seleccionados' => 'required'
        );

        if ($this->exists)
        {
            //Evitamos que la regla “unique” tome en cuenta el email del usuario actual
//            $rules['username'] .= ',username,' . $id;
        }


        $messages = array(
            'nombre.required' => 'Debe ingresar el nombre del usuario',
            'nombre.min' => 'El nombre debe ser de al menos 4 caracteres',
            'nombre.max' => 'El nombre debe ser de menos de 50 caracteres',
            'apellido.required' => 'Debe ingresar el apellido del usuario',
            'apellido.min' => 'El apellido debe ser de al menos 3 caracteres',
            'apellido.max' => 'El apellido debe ser de menos de 50 caracteres',
            'username.required' => 'Debe ingresar el usuario',
            'username.min' => 'El usuario debe ser de al menos 4 caracteres',
            'username.max' => 'El usuario debe ser de menos de 50 caracteres',
            'tipo_usuario.required' => 'Debe seleccionar el tipo del usuario',
            'negocios_seleccionados.required' => 'El usuario debe tener a menos un negocio seleccionado'
        );

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->passes())
        {
            return true;
        }

        $this->errors = $validator->errors();

        return false;
    }

    public static function listado()
    {
        $results = self::orderBy('id','asc')
            ->leftJoin('tipos_usuarios', 'users.tipo_usuario', '=', 'tipos_usuarios.id')
            ->get(array('users.id as id','tipos_usuarios.tipo_usuario as tipo_usuario','users.nombre as nombre','users.apellido as apellido','users.username as username','users.estado','users.password'));
        foreach($results as $r)
            $r->estado = HelperEstado::darEstado($r->estado);
        return $results;
    }

    public function cambiarEstado($id,$estado)
    {
        if($estado == "Activo")
        {
            self::where("id",$id)->update(
                array("estado" => 1)
            );
        }
        else
        {
            self::where("id",$id)->update(
                array("estado" => 0)
            );

        }
    }

    public function reiniciarPassword($id)
    {
        self::where("id",$id)->update(
            array("password" => Hash::make("123456"))
        );
    }

    public function usuarioxnegocio(){

        $repoUsuarioXNegocio = new RepoUsuarioXNegocio();
        return $repoUsuarioXNegocio->darNegociosSeleccionadosPorUsuario($this->id);
    }

    public function negocioActual()
    {
        $repoUsuarioXNegocio = new RepoUsuarioXNegocio();
        return $repoUsuarioXNegocio->darNegocioActual($this->id);
    }

    public static function darListaUsuarios($id_negocio="")
    {
        if($id_negocio)
        {
            return self::whereNotIn('id', function($query) use ($id_negocio)
            {
                $query->select("id_usuario")
                    ->from('usuariosxnegocios')
                    ->where('usuariosxnegocios.id_negocio',$id_negocio);
            })
                ->get(array('users.id','users.username','users.estado'));
        }
        else
            return self::where('estado',0)->get(array('id','username','estado'));
    }




}
