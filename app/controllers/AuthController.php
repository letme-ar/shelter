<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 25/10/14
 * Time: 20:41
 */
use Shelter\Repositories\RepoUsuarioXNegocio;
class AuthController extends BaseController {

    protected $repoUsuarioXNegocio;
    public function __construct(RepoUsuarioXNegocio $repoUsuarioXNegocio)
    {
        $this->repoUsuarioXNegocio = $repoUsuarioXNegocio;

    }
    /*
    |--------------------------------------------------------------------------
    | Controlador de la autenticación de usuarios
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        // Verificamos que el usuario no esté autenticado
        if (Auth::check())
        {
            // Si está autenticado lo mandamos a la raíz donde estara el mensaje de bienvenida.
            return Redirect::to('/');
        }
        // Mostramos la vista login.blade.php (Recordemos que .blade.php se omite.)
        return View::make('login');
    }
    /*
    * Valida los datos del usuario.
    */
    public function postLogin()
    {
        // Guardamos en un arreglo los datos del usuario.
        $userdata = array(
            'username' => Input::get('username'),
            'password'=> Input::get('password')
        );
//        dd($userdata);
        // Validamos los datos y además mandamos como un segundo parámetro la opción de recordar el usuario.
        if(Auth::attempt($userdata, Input::get('remember-me', 0)))
        {
            // De ser datos válidos nos mandara a la bienvenida
            return Redirect::to('/');
        }
        // En caso de que la autenticación haya fallado manda un mensaje al formulario de login y también regresamos los valores enviados con withInput().
        return Redirect::to('login')
            ->with('mensaje_error', 'Tus datos son incorrectos')
            ->withInput();
    }

    /**
     * Muestra el formulario de login mostrando un mensaje de que cerró sesión.
     */
    public function logOut()
    {
        Auth::logout();
        return Redirect::to('login')
            ->with('mensaje_error', 'Tu sesión ha sido cerrada.');
    }

    public function mostrarCambiarPassword()
    {
        $action = "Modificar";
        $ruta_index = route("calendario.index");
        return View::make("cambiarpass",compact("action","ruta_index"));
    }

    public function cambiarPassword(){

        $user = Auth::user();
        $rules = array(
            'new_password' => 'required|alphaNum|between:6,16|confirmed'
        );

        $messages = array(
            'new_password.required' => 'Debe ingresar la contraseña nueva',
            'new_password.alphaNum' => 'La contraseña nueva debe ser alfanumérica',
            'new_password.between' => 'La contraseña nueva debe tener entre 6 y 16 caracteres',
            'new_password.confirmed' => 'Las contraseñas nuevas no coinciden'
        );

        $validator = Validator::make(Input::all(), $rules,$messages);

        if ($validator->fails())
        {
            return Redirect::action('AuthController@mostrarCambiarPassword',$user->id)->withErrors($validator);
        }
        else
        {
            $user->password = Hash::make(Input::get('new_password'));
            $user->save();
            return Redirect::action('AuthController@postLogin',$user->id)->withMessage("Password have been changed");

        }
    }

    public function cambiarNegocioAdministrado($datos)
    {
        $array = explode("-",$datos);
        $id_usuario = $array[0];
        $id_negocio = $array[1];
        $this->repoUsuarioXNegocio->actualizarNegocioAdministrado($id_usuario,$id_negocio);
        return Redirect::action('AuthController@postLogin',$id_usuario)->withMessage("Password have been changed");

    }

}