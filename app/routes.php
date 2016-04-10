<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('login', 'AuthController@showLogin');

// Validamos los datos de inicio de sesión.
Route::post('login', 'AuthController@postLogin');

// Nos indica que las rutas que están dentro de él sólo serán mostradas si antes el usuario se ha autenticado.
Route::group(array('before' => 'auth'), function()
{
    // Esta ruta nos servirá para cerrar sesión.
    Route::get('/', 'CalendarioController@index');
    Route::get("calendario/index",array('as' => 'calendario.index','uses'  => 'CalendarioController@index'));
    Route::post("calendario/darReservasXSala",array('as' => 'calendario.darReservasXSala','uses'  => 'CalendarioController@darReservasXSala'));
    Route::post("calendario/nuevoEvento",array('as' => 'calendario.nuevoEvento','uses'  => 'CalendarioController@nuevoEvento'));
    Route::get("calendario/nuevoEvento",array('as' => 'calendario.nuevoEvento','uses'  => 'CalendarioController@nuevoEvento'));
    Route::get("calendario/nuevoEventoResponsive",array('as' => 'calendario.nuevoEventoResponsive','uses'  => 'CalendarioController@nuevoEventoResponsive'));
    Route::post("calendario/darComboEnd",array('as' => 'calendario.darComboEnd','uses'  => 'CalendarioController@darComboEnd'));
    Route::post("calendario/actualizarEvento",array('as' => 'calendario.actualizarEvento','uses'  => 'CalendarioController@actualizarEvento'));
    Route::post("calendario/guardarReservaResponsive",array('as' => 'calendario.guardarReservaResponsive','uses'  => 'CalendarioController@guardarReservaResponsive'));
    Route::post("calendario/eliminarEvento",array('as' => 'calendario.eliminarEvento','uses'  => 'CalendarioController@eliminarEvento'));
    Route::post("calendario/cambiarSala",array('as' => 'calendario.cambiarSala','uses'  => 'CalendarioController@actualizarSalaPrincipal'));
    Route::post("calendario/darContactoPrincipal",array('as' => 'calendario.darContactoPrincipal','uses'  => 'CalendarioController@darContactoPrincipal'));
    Route::post("calendario/validarVencidas",array('as' => 'calendario.validarVencidas','uses'  => 'CalendarioController@validarVencidas'));
    Route::post("calendario/actualizarGanadasPerdidas",array('as' => 'calendario.actualizarGanadasPerdidas','uses'  => 'CalendarioController@actualizarGanadasPerdidas'));
    Route::post("calendario/validarDatos",array('as' => 'calendario.validarDatos','uses'  => 'CalendarioController@validarDatos'));
    Route::resource("calendario","CalendarioController");


    Route::get("auth/{id}/cambiarNegocioAdministrado",array('as' => 'auth.cambiarNegocioAdministrado','uses'  => 'AuthController@cambiarNegocioAdministrado'));
    Route::get("auth/mostrarCambiarPassword",array('as' => 'auth.mostrarCambiarPassword','uses'  => 'AuthController@mostrarCambiarPassword'));
    Route::get('logout', 'AuthController@logOut');
    Route::post("auth/cambiarPassword",array('as' => 'auth.cambiarPassword','uses'  => 'AuthController@cambiarPassword'));

    Route::get("auth/logout",array('as' => 'auth.logout','uses'  => 'AuthController@logout'));

    Route::post("grupo/actualizar",array('as' => 'grupo.actualizar','uses'  => 'GrupoController@actualizar'));
    Route::get("grupo/darListaGruposAutocompletar",array('as' => 'grupo.darListaGruposAutocompletar','uses'  => 'GrupoController@darListaGruposAutocompletar'));
    Route::get("grupo/nuevoGrupo",array('as' => 'grupo.nuevoGrupo','uses'  => 'GrupoController@nuevoGrupo'));
    Route::post("grupo/analizarGrupo",array('as' => 'grupo.analizarGrupo','uses'  => 'GrupoController@analizarGrupo'));
    Route::post("grupo/validarDatos",array('as' => 'grupo.validarDatos','uses'  => 'GrupoController@validarDatos'));
    Route::post("grupo/agregarContacto",array('as' => 'grupo.agregarContacto','uses'  => 'GrupoController@agregarContacto'));
    Route::post("grupo/destroy",array('as' => 'grupo.borrar','uses'  => 'GrupoController@destroy'));
    Route::post("grupo/eliminarContacto",array('as' => 'grupo.borrarContacto','uses'  => 'GrupoController@borrarContacto'));
    Route::resource("grupo","GrupoController");

    Route::resource("insumo","InsumoController");

    Route::post("venta/anular",array('as' => 'venta.anular','uses'  => 'VentaController@anular'));
    Route::post("venta/validarDatos",array('as' => 'venta.validarDatos','uses'  => 'VentaController@validarDatos'));
    Route::post("venta/eliminarProducto",array('as' => 'venta.eliminarProducto','uses'  => 'VentaController@eliminarProducto'));
    Route::get("venta/{id}/verDetalle",array('as' => 'venta.verDetalle','uses'  => 'VentaController@verDetalle'));
    Route::get("venta/darListaProductosAutocompletar",array('as' => 'venta.darListaProductosAutocompletar','uses'  => 'VentaController@darListaProductoAutocompletar'));
    Route::post("venta/productoConfirmado",array('as' => 'venta.productoConfirmado','uses'  => 'VentaController@productoConfirmado'));
    Route::post("venta/darProductoCorrecto",array('as' => 'venta.darProductoCorrecto','uses'  => 'VentaController@productoCorrecto'));
    Route::post("venta/productoSeleccionado",array('as' => 'venta.productoSeleccionado','uses'  => 'VentaController@productoSeleccionado'));
    Route::post("venta/search",array('as' => 'venta.search','uses'  => 'VentaController@search'));
    Route::resource("venta","VentaController");

    Route::post("producto/validarDatos",array('as' => 'producto.validarDatos','uses'  => 'ProductoController@validarDatos'));
    Route::post("producto/{id}/actualizarStock",array('as' => 'producto.actualizarStock','uses'  => 'ProductoController@actualizarStock'));
    Route::get("producto/{id}/agregarStock",array('as' => 'producto.agregarStock','uses'  => 'ProductoController@agregarStock'));
    Route::post("producto/{id}/actualizar",array('as' => 'producto.actualizar','uses'  => 'ProductoController@actualizar'));
    Route::resource("producto","ProductoController");


    Route::post("servicio/{id}/actualizar",array('as' => 'servicio.actualizar','uses'  => 'ServicioController@actualizar'));
    Route::post("servicio/validarDatos",array('as' => 'servicio.validarDatos','uses'  => 'ServicioController@validarDatos'));
    Route::resource("servicio","ServicioController");

    Route::post("negocio/validarDatos",array('as' => 'negocio.validarDatos','uses'  => 'NegocioController@validarDatos'));
    Route::post("negocio/darComboLocalidades","NegocioController@darComboLocalidades");
    Route::post("negocio/agregarTelefono",array('as' => 'negocio.agregarTelefono','uses'  => 'NegocioController@agregarTelefono'));
    Route::post("negocio/eliminarTelefono",array('as' => 'negocio.borrarTelefono','uses'  => 'NegocioController@borrarTelefono'));
    Route::post("negocio/agregarSala",array('as' => 'negocio.agregarSala','uses'  => 'NegocioController@agregarSala'));
    Route::post("negocio/eliminarSala",array('as' => 'negocio.borrarSala','uses'  => 'NegocioController@borrarSala'));
    Route::post("negocio/actualizar",array('as' => 'negocio.actualizar','uses'  => 'NegocioController@actualizar'));
    Route::post("negocio/desactivar",array('as' => 'negocio.desactivar','uses'  => 'NegocioController@desactivar'));
    Route::resource("negocio","NegocioController");

    Route::post("usuario/validarDatos",array('as' => 'usuario.validarDatos','uses'  => 'UsuarioController@validarDatos'));
    Route::post("usuario/cambiarEstado",array('as' => 'usuario.cambiarEstado','uses'  => 'UsuarioController@cambiarEstado'));
    Route::post("usuario/reiniciarPassword",array('as' => 'usuario.reiniciarPassword','uses'  => 'UsuarioController@reiniciarPassword'));
    Route::post("usuario/actualizar",array('as' => 'usuario.actualizar','uses'  => 'UsuarioController@actualizar'));
    Route::resource("usuario","UsuarioController");

});


