<?php namespace Shelter\Entities;
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 13/03/15
 * Time: 13:29
 */
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Shelter\Repositories\RepoUsuarioXNegocio;

class User extends \Eloquent implements UserInterface, RemindableInterface
{

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $fillable = array('id', 'username', 'password', 'nombre', 'apellido', 'tipo_usuario', 'estado');

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

    public function getEstadoTitleAttribute()
    {
        return \Lang::get('utils.estado.'.$this->estado);

    }

    public function usuarioxnegocio(){

        $repoUsuarioXNegocio = new RepoUsuarioXNegocio();
        return $repoUsuarioXNegocio->darNegociosSeleccionadosPorUsuario($this->id);
    }

    public function negocioActual()
    {
        $usuarioxnegocio = new RepoUsuarioXNegocio();
        return $usuarioxnegocio->darNegocioActual(\Auth::user()->id);
    }


}