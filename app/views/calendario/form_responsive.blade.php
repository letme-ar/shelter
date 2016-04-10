@extends("master")

@section ('script')
<script>
    $().ready(function(){

        $("#fecha").datepicker({
            dateFormat: "dd/mm/yy"
        });


        $("#id_estado_reserva").prop('selectedIndex', 1);
        $("#id_estado_reserva").prop('disabled', true);

        $("#id_grupo").change(function(){
            var id = $("#id_grupo").val();
            var destino = "{{ Route('calendario.darContactoPrincipal') }}";
            var datos = "id_grupo="+id;
            $.ajax({
                url:  destino,
                type: "post",
                data: datos,
                async: true,
                success:function(respuesta)
                {
                    $("#contacto").val(respuesta);
                }
            });
        });

        $("#start").change(function(){
            var id = $("#start").val();
            var destino = "{{ Route('calendario.darComboEnd') }}";
            var datos = "start="+id;
            $.ajax({
                url:  destino,
                type: "post",
                data: datos,
                async: true,
                success:function(respuesta)
                {
                    $("#div_end").html(respuesta);
                }
            });
        });

        $("#btnAceptar").click(function(){
            var datos = $('#frmReserva').serialize();
            var destino = "{{ Route('calendario.validarDatos') }}";
            $.ajax({
                type: "Post",
                url: destino,
                data: datos,
                async: true,
                success: function(respuesta){
                    if(respuesta)
                    {
                        darMensaje("mensaje",300,250,respuesta);
                    }
                    else
                    {
                        frmReserva.submit();
                    }
                }

            })

        });




    });

</script>


@stop
@section ('content')
    <h1> {{ $action }} una reserva</h1>

    <div class="page-header">

        {{ Form::model($model,$data_formulario, array('role' => 'form')) }}

        {{ Field::text('fecha','Fecha', $fecha_actual, ['id' => 'fecha','readOnly' => 'readOnly'] ) }}

        {{ Field::select('id_grupo','Grupo',$combo_grupos,null,['id' => 'id_grupo']) }}

        {{ Field::text('body','Comentario', null, ['placeholder' => 'Comentario de la reserva'] ) }}

        {{ Field::select('start','Ingreso',$combo_horarios,null,['id' => 'start']) }}

        <div id="div_end">{{ Field::select('end','Salida',$combo_horarios,null,['id' => 'end']) }} </div>

        {{ Field::text('contacto','Contacto', null, ['id' => 'contacto','disabled' => 'disabled'] ) }}

        {{ Field::select('id_estado_reserva','Estado de la reserva',$combo_estados,null,['id'=>'id_estado_reserva']) }}

        {{ Field::select('servicio','Servicio',$combo_servicios,null,[]) }}

        @include("fields.botones_button")

        {{ Form::close() }}

        <div id="mensaje"></div>


    </div>
@stop