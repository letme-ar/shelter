<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Shelter')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Bootstrap core CSS -->
    {{ HTML::script('assets/js/jquery.js') }}
    {{ HTML::script('assets/js/jquery-ui.min.js') }}
    {{ HTML::script('assets/js/bootstrap.min.js') }}
    {{ HTML::script('assets/js/bootstrap-dialog.js') }}
    {{ HTML::script('assets/js/jquery.dataTables.js') }}
    {{ HTML::script('assets/js/jquery.multiselect.js') }}
    {{ HTML::script('assets/js/funciones.js') }}
    {{ HTML::script('assets/js/dataTables.bootstrap.js') }}
    {{ HTML::script('assets/js/BlockUI.js') }}
    {{ HTML::script('assets/js/hammer.js') }}
    {{ HTML::style('assets/css/bootstrap.min.css', array('media' => 'screen')) }}
    {{ HTML::style('assets/css/bootstrap-dialog.css', array('media' => 'screen')) }}
    {{ HTML::style('assets/css/jquery.multiselect.css', array('media' => 'screen')) }}
    {{ HTML::style('assets/css/bootstrap-theme.min.css', array('media' => 'screen')) }}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">


    <style type="text/css">
              @import url(http://fonts.googleapis.com/css?family=Roboto+Condensed:700);
                    body {
                        background-color: #FFF;
                    }
                    .navbar-brand {
                        font-family: 'Roboto Condensed', sans-serif;
                        font-size: 20px;
                    }
                    .navbar-nav > li > a {
                        padding-top: 20px;
                        padding-bottom: 20px;
                    }
                    .navbar-header {
                        margin-top: 3px;
                    }
                    #footer > .container {
                        border: 1px solid #171717;
                        background-color: #282828;
                        -webkit-border-radius: 7px;
                        -moz-border-radius: 7px;
                        text-align: center;
                        max-width: 1170px;
                        width: auto;
                        margin-top: 10px;
                        margin-left: auto;
                        margin-right: auto;
                        border-radius: 10px;
                        position: fixed !important;
                        bottom: 0;
                    }
                    .container .text-muted {
                        margin: 20px 15px;
                    }
                    /* navegador */
                    .navbar-inverse .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:hover, .navbar-inverse .navbar-nav > .active > a:focus {
                        color: #fff;
                        background-color: #0d3f87;
                    }
                    .navbar-inverse .navbar-nav > .open > a, .navbar-inverse .navbar-nav > .open > a:hover, .navbar-inverse .navbar-nav > .open > a:focus {
                        color: #fff;
                        background-color: #0d3f87;
                    }
                    .navbar-inverse .navbar-nav > li > a {
                        color: #b7d7f3;
                    }
                    .navbar-inverse .navbar-brand {
                        color: #b7d3ec;
                    }
                    .navbar-default .navbar-link:hover {
                        color: #333;
                    }
                    .navbar-inverse {
                        /*background-color: #2e72af;*/
                        border-color: #1a568c;
                        background: -webkit-linear-gradient(top, #4ca4d6 0%, #0a4aa8 100%); /* Chrome10+,Safari5.1+ */
                        background: -o-linear-gradient(top, #4ca4d6 0%, #0a4aa8 100%); /* Opera 11.10+ */
                        background: -ms-linear-gradient(top, #4ca4d6 0%, #0a4aa8 100%); /* IE10+ */
                        border-bottom: 1px solid #0d3f87;
                    }
                    .contenedor {
                        background-color: #f5f5f5;
                        border: 1px solid #b6b6b6;
                        border-radius: 7px;
                        -webkit-border-radius: 7px;
                        -moz-border-radius: 7px;
                        /* Webkit (Safari/Chrome) */ -webkit-box-shadow: 0px 0px 9px 7px rgba(180,180,180, 0.1);
                        /* Mozilla Firefox */ -moz-box-shadow: 0px 0px 9px 7px rgba(180,180,180, 0.1);
                        /* Proposed W3C Markup */ box-shadow: 0px 0px 9px 7px rgba(180,180,180, 0.1);
                    }
                    .dropdown-submenu {
                        position: relative;
                    }
                    .dropdown-submenu>.dropdown-menu {
                        top: 0;
                        left: 100%;
                        margin-top: -6px;
                        margin-left: -1px;
                        -webkit-border-radius: 0 6px 6px 6px;
                        -moz-border-radius: 0 6px 6px 6px;
                        border-radius: 0 6px 6px 6px;
                    }
                    .dropdown-submenu:hover>.dropdown-menu {
                        display: block;
                    }
                    .dropdown-submenu>a:after {
                        display: block;
                        content: " ";
                        float: right;
                        width: 0;
                        height: 0;
                        border-color: transparent;
                        border-style: solid;
                        border-width: 5px 0 5px 5px;
                        border-left-color: #cccccc;
                        margin-top: 5px;
                        margin-right: -10px;
                    }
                    .dropdown-submenu:hover>a:after {
                        border-left-color: #ffffff;
                    }
                    .dropdown-submenu.pull-left {
                        float: none;
                    }
                    .dropdown-submenu.pull-left>.dropdown-menu {
                        left: -100%;
                        margin-left: 10px;
                        -webkit-border-radius: 6px 0 6px 6px;
                        -moz-border-radius: 6px 0 6px 6px;
                        border-radius: 6px 0 6px 6px;
                    }

                    .footer{
                        position: fixed;
                        bottom: 0;
                        border: 1px solid #171717;
                        background-color: #282828;
                        -webkit-border-radius: 7px;
                        -moz-border-radius: 7px;
                        text-align: center;
                        display: block;
                        width: 100%;
                    }

                    .ui-dialog-titlebar-close {
                      visibility: hidden;
                    }

              .calendario_celular{
                  display: none;
              }

              #demo {
                  width: 500px;
                  height: 500px;
                  visibility: hidden;
                  margin: 100px auto;
                  background: #457;
                  cursor: hand;
                  cursor: -moz-grab;
                  cursor: -webkit-grab;
                  cursor: grab;
              }

              #demo li.first {
                  background: #577;
              }

              #demo li.middle {
                  background: #1e8;
              }

              #demo li.last {
                  background: #e8b;
              }

              #dragend {
                  position: absolute;
                  bottom: 50px;
                  right: 50px;
                  background: #345;
                  padding: 18px;
                  color: #fff;
                  border-radius: 3px;
                  width: 150px;
                  font-size: 15px;
              }

              #dragend h1 {
                  font-size: 15px;
                  font-weight: normal;
                  margin-bottom: 12px;
              }

              #dragend a {
                  text-decoration: underline;
                  color: #fff
              }

              .menu-responsive{
                  display:none;
              }
              .menu-normal
              {
                  display: inline-block;
              }


    </style>
    <style media="screen">

        @media (max-width: 480px) {
            .celular{
                display: none;
            }
        }
        @media (max-width: 640px) {
            .tablet{
                display: none;
            }
            .calendario_web{
                display: none;
            }
            .calendario_celular{
                display: block;
                margin-top: 2px;
            }
        }
        @media (max-width: 767px) {
            .menu-responsive{
                display:inline-block;
            }
            .menu-normal
            {
                display: none;
            }
        }
    </style>
    <script>

        function bloquear()
        {

            $.blockUI({ message: '<h1><img src="{{URL::asset("images/cargando.gif")}}" /> Cargando...</h1>' });
        }

        function desbloquear()
        {
            $.unblockUI();
        }

        $().ready(function()
        {


            /*$("a").click(function(){
               bloquear();
            });

            $("button").click(function(){
                bloquear();
            });

            $("#li_user").click(function(){
                desbloquear();
            });

            $("#li_negocio").click(function(){
                desbloquear();
            });

            $("#li_shelter").click(function(){
                desbloquear();
            });

            $("#boton_mobile").click(function(){
                desbloquear();
            });*/


        });

    </script>

    @yield('script')


</head>
<body>
<!-- Static navbar -->
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button id="boton_mobile" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" id="li_shelter">Shelter</a>
        @if(isset($combo_salas))
            <a class="navbar-brand menu-responsive" href="#" id="li_shelter">Sala: {{ $combo_salas }}</a>
        @endif
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="{{ route('grupo.index') }}">Grupos</a>
        </li>
      </ul>
        @if(Auth::user()->tipo_usuario != 1)
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="{{ route('insumo.index') }}">Insumos</a>
            </li>
        </ul>
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="{{ route('calendario.index') }}">Calendario</a>
            </li>
        </ul>
        @endif

        @if(Auth::user()->tipo_usuario == 1)
        <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="{{ route('negocio.index') }}">Negocios</a>
            </li>
        </ul>

        <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="{{ route('usuario.index') }}">Usuarios</a>
            </li>
        </ul>
      @endif
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="li_user">{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ route('auth.mostrarCambiarPassword') }}">Cambiar contraseña</a></li>
            <li><a href="{{ route('auth.logout') }}">Salir</a></li>
          </ul>
        </li>
      </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                @if(Auth::user()->tipo_usuario != 1)
                    @foreach(Auth::user()->usuarioxnegocio() as $negocio)
                        @if($negocio->principal == 1)
                        <a id="li_negocio" href="#" class="dropdown-toggle" data-toggle="dropdown">Negocio actual: {{ $negocio->nombre }}<span class="caret"></span></a>
                        @else
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('auth.cambiarNegocioAdministrado',Auth::user()->id."-".$negocio->id) }}">Administrar {{ $negocio->nombre }}</a></li>
                        </ul>
                        @endif
                    @endforeach
                @endif
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><!-- pedidos1@aphalergo.com.ar Asunto Paciente-->

<!-- Fin Static navbar -->

<div class="container contenedor">

    @yield('content')
</div>
<div id="popup_mensaje"></div>
<div id="" class="footer">
    <div class="container">
        <p class="text-muted">LETME</p>
    </div>
</div>

</body>
</html>
