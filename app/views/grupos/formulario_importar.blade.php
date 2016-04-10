@extends ('master')
@section ('script')

<script>
    $().ready(function()
    {
        @if($permitir_modificar)



        $("#btnAceptar").click(function(){
            var datos = $('#frmGrupo').serialize();
            var destino = "{{ Route('grupo.validarDatos') }}";
            $.ajax({
                type: "Post",
                url: destino,
                data: datos,
                async: false,
                success: function(respuesta){
                    if(respuesta)
                        darMensaje("mensaje",300,500,respuesta);
                    else
                        frmGrupo.submit();
                }

            })

        });
        @if($nombre)
        $("#nombre").attr("readonly","readonly");
        @endif
        $("#btnAgregarContacto").click(function(){
            var nombre = $("#nombrecontacto").val();
            var telefono = $("#telefonocontacto").val();
            var resultado = validarTelefono(telefono);
//            alert(nombre);
            if(!nombre)
                darMensaje("mensaje",200,400,"Debe completar el nombre del contacto");
            else if(!telefono)
                darMensaje("mensaje",200,400,"Debe completar el telefono del contacto");
            else if(resultado)
                darMensaje("mensaje",200,400,resultado);
            else
            {
                var destino = "{{ Route('grupo.agregarContacto') }}";
                var datos = "nombrecontacto="+nombre+"&telefonocontacto="+telefono;
                //var respuesta = peticionAjax(datos,"post",destino);

                $.ajax({
                    url:  destino,
                    type: "post",
                    data: datos,
                    async:  true,
                    success:function(respuesta){
                        $("#divContactos").html(respuesta);
                        $("#nombrecontacto").val("");
                        $("#telefonocontacto").val("");
                    }
                });
            }
        });
    });
</script>




@stop
@section ('content')
<h1> {{ $action }} un grupo</h1>
@if ($errors->any())
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Por favor corrige los siguientes errores:</strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="page-header">
    {{ Form::model($grupo,$data_formulario, array('role' => 'form')) }}
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('nombre', 'Nombre del grupo') }}
            {{ Form::text('nombre', $nombre, array('placeholder' => 'Introduce un nombre para el grupo', 'class' => 'form-control')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('id_estilo', 'Estilo del grupo') }}
            {{ Form::select('id_estilo', $combo_estilos, null, array('class' => 'form-control')) }}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('facebook', 'Facebook del grupo') }}
            {{ Form::text('facebook', null, array('placeholder' => 'Introduce el facebook del grupo', 'class' => 'form-control')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('twitter', 'Twitter del grupo') }}
            {{ Form::text('twitter', null, array('placeholder' => 'Introduce el twitter del grupo', 'class' => 'form-control')) }}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('integrantes', 'Integrantes del grupo') }}
            {{ Form::text('integrantes', null, array('placeholder' => 'Ingrese los integrantes del grupo', 'class' => 'form-control')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('web', 'Web del grupo') }}
            {{ Form::text('web', null, array('placeholder' => 'Ingrese la web del grupo', 'class' => 'form-control')) }}
        </div>
    </div>
    <div class="form-inline ">
        <div class="form-group">
            {{ Form::label('contactos', 'Contactos') }}
            <div id="contactos">
                <div class="form-group">
                    {{ Form::label('nombrecontacto', '', array('class' => 'sr-only', 'for' => 'nombrecontacto')) }}
                    {{ Form::text('nombrecontacto', "", array('placeholder' => 'Nombre del contacto', 'class' => 'form-control','id' => 'nombrecontacto')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('telefonocontacto', '', array('class' => 'sr-only', 'for' => 'telefonocontacto')) }}
                    {{ Form::text('telefonocontacto', "", array('placeholder' => 'Telefono del contacto', 'class' => 'form-control','id' => 'telefonocontacto')) }}
                </div>
                {{ Form::button('Agregar',array('type' => 'button', 'class' => 'btn btn-secundary','id' => 'btnAgregarContacto')) }}
            </div>
        </div>
    </div>

    <div id="divContactos">{{ $contactos }}</div>

    <br>

    <div class="row">
        <div class="form-group col-md-4">
            {{ Form::button($action. '',array('type' => 'button', 'class' => 'btn btn-primary', 'id' => 'btnAceptar')) }}
            <a href="{{ route('grupo.index') }}" class="btn btn-primary">Cancelar</a>
        </div>
    </div>

    <div id="mensaje"></div>
</div>
{{ Form::close() }}
@stop