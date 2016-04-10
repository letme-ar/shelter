@extends ('master')
@section ('script')

    <style>

    .hora{
        width: auto;
        display: block;
        padding: 10px;
        border: 1px solid #269abc;
        font: arial, helvetica;
        font-weight: bold;
        -webkit-border-radius: 5px 10px;/* Safari  */
        -moz-border-radius: 5px 10px;     /* Firefox */
    }

    .evento{
        margin-left: 20px;
    }

    .fecha{
        display: block;
        width: 95%;
        padding-top: -20px;
        padding-bottom: 10px;
    }

    .boton_anterior{
        display: inline-block;
        width: 15%;
    }

    .label_fecha{
        display: inline-block;
        width: 65%;
        text-align: center;

    }

    .boton_siguiente{
        display: inline-block;
        width: 15%;
        float: right;
        text-align: right;

    }

    #calendario_celular{
        overflow: auto;
        height: 300px;
    }
    </style>

<script>


    var fecha = new Date();
    var hoy = new Date();
    var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");


    function darAyer()
    {
        var fecha = parseFloat(darDiaActual()) - 24*60*60*1000;
        var ayer = new Date(fecha);
        guardarDiaActual(ayer.getTime());
        var mes = ayer.getMonth()+1;
        return diasSemana[ayer.getDay()]+" "+ayer.getDate()+"/"+mes+"/"+ayer.getFullYear();
    }

    function darManana()
    {
        var fecha = parseFloat(darDiaActual()) + 1*24*60*60*1000;
        var manana = new Date(fecha);
        guardarDiaActual(manana.getTime());
        var mes = manana.getMonth()+1;
        return diasSemana[manana.getDay()]+" "+manana.getDate()+"/"+mes+"/"+manana.getFullYear();

    }

    function darDiaActual()
    {
        return $("#hidden_fecha").val();

    }

    function guardarDiaActual(valor_dia)
    {
        $("#hidden_fecha").val(valor_dia);
    }



</script>


    <style type="text/css">
        *,
        *:before,
        *:after {
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
        }

        select[readonly]{
            background: #eee;
            cursor:no-drop;
        }
        </style>
    <link rel='stylesheet' type='text/css' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/start/jquery-ui.css' />
	{{ HTML::style('assets/css/jquery.weekcalendar.css', array('media' => 'screen')) }}

    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js'></script>
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js'></script>
    {{ HTML::script('assets/js/jquery.weekcalendar.js') }}
    {{ HTML::script('assets/js/BlockUI.js') }}
    @include("calendario.scripts")

    <script>


    </script>

@stop
@section ('content')
<div class="row">
    <div class="form-group col-md-4 menu-normal" style="padding-top: 10px">
        {{ Form::label('id_sala', 'Sala seleccionada') }}
        {{ $combo_salas }}
    </div>
    <div class="calendario_celular">
        <input type="hidden" value="" id="hidden_fecha" />
        <div class="fecha">
            <div class="boton_anterior"><a title="Anterior" href="#">{{ HTML::image('images/anterior.png', "Imagen no encontrada",array("id" => "anterior","style" => "height: 32px; width: 32px;","class" => "invert") ) }}</a></div>
            <div class="label_fecha"><label id="fecha_actual"></label><a style="margin-left: 10px" title="Agregar" href="{{ route('calendario.nuevoEventoResponsive') }}">{{ HTML::image('images/agregar.png', "Imagen no encontrada",array("id" => "agregar","style" => "height: 32px; width: 32px") ) }}</a></div>
            <div class="boton_siguiente"><a title="Siguiente" href="#">{{ HTML::image('images/siguiente.png', "Imagen no encontrada",array("id" => "siguiente","style" => "height: 32px; width: 32px") ) }}</a></div>
        </div>
        <div id="calendario_celular"></div>
    </div>
    <div id='calendar' class="calendario_web"></div>
	<div id="event_edit_container">
    		<form>
    			<input type="hidden" />
                <h3 style="text-align: center"><span>Dia: </span><span class="date_holder"></span></h3>
                <div class="row">
                    <div class="form-group col-md-5">
                        {{ Form::label('id_grupo', 'Grupo') }}
                        {{ $combo_grupos }}
                    </div>
                   <div class="form-group col-md-5">
                        {{ Form::label('body', 'Comentario') }}
                        <input type="text" name="body" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        {{ Form::label('start', 'Ingreso') }}
                        <select name="start"><option value="">Ingreso</option></select>
                    </div>
                    <div class="form-group col-md-4">
                        {{ Form::label('end', 'Salida') }}
                        <select name="end"><option value="">Salida</option></select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5" >
                        {{ Form::label('contacto', 'Contacto') }}
                        <input type="text" name="contacto" id="contacto"  style="width: 200px"   disabled   />
                    </div>
                    <div class="form-group col-md-4">
                        {{ Form::label('estado_reserva', 'Estado') }}
                        {{ $combo_estados }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        {{ Form::label('servicio', 'Servicio') }}
                        {{ $combo_servicios }}
                    </div>
                    <div class="form-group col-md-5" style="display: none">
                        {{ Form::label('title', 'Titulo') }}
                        <input type="text" name="title" />
                    </div>
                </div>


    		</form>
    	</div>

    </div>

    <div id="mensaje" class="calendario_web"></div>
    <div id="mensaje2" class="calendario_web"></div>

</div>



@stop