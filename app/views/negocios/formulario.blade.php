@extends ('master')
@section ('script')

@include("negocios.scripts")
@include("negocios.css")

@stop
@section ('content')
<h1> {{ $action }} un negocio</h1>

<div class="page-header">
    {{ Form::model($model,$data_formulario, array('role' => 'form')) }}
    {{ Field::text('nombre','Nombre del negocio', null, ['placeholder' => 'Introduce el nombre del negocio'] ) }}

    {{ Field::text('direccion','Dirección del negocio', null, ['placeholder' => 'Introduce la direccion del negocio'] ) }}
        <div class="form-group col-md-6">
            {{ Form::label('id_provincia', 'Provincia del negocio') }}
            <div id="div_provincias">{{ $combo_provincias }}</div>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('id_localidad', 'Localidad del negocio') }}
            <div id="div_localidades">{{ $combo_localidades }}</div>
        </div>

    {{ Field::text('facebook','Facebook del negocio', null, ['placeholder' => 'Introduce facebook del negocio'] ) }}

    {{ Field::text('twitter','Twitter del negocio', null, ['placeholder' => 'Introduce twitter del negocio'] ) }}

    <div class="form-group col-md-6">
        {{Form::label('mail','Mail del negocio')}}
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">@</span>
            {{Form::text('mail',null,array('placeholder' => 'Introduce el mail del negocio', 'class' => 'form-control'))}}
        </div>
    </div>


    {{ Field::text('web','Web del negocio', null, ['placeholder' => 'Introduce la web del negocio'] ) }}

    <div class="form-inline ">
        <div class="form-group col-md-6">
            {{ Form::label('sala', 'Sala') }}
            <div id="contactos">
                <div class="form-group">
                    {{ Form::label('sala', '', array('class' => 'sr-only', 'for' => 'sala')) }}
                    {{ Form::text('sala', "", array('placeholder' => 'Sala del negocio', 'class' => 'form-control','id' => 'sala')) }}
                </div>
                {{ Form::button('Agregar',array('type' => 'button', 'class' => 'btn btn-success','id' => 'btnAgregarSala')) }}
            </div>
            <div id="divSalas">{{ $salas }}</div>
        </div>
    </div>


    <div class="form-inline ">
        <div class="form-group col-md-6">
            {{ Form::label('telefono', 'Telefono') }}
            <div id="contactos">
                <div class="form-group">
                    {{ Form::label('telefono', '', array('class' => 'sr-only', 'for' => 'telefono')) }}
                    {{ Form::text('telefono', "", array('placeholder' => 'Telefono del negocio', 'class' => 'form-control','id' => 'telefono')) }}
                </div>
                {{ Form::button('Agregar',array('type' => 'button', 'class' => 'btn btn-success','id' => 'btnAgregarTelefono')) }}
            </div>
            <div id="divTelefonos">{{ $telefonos }}</div>
       </div>
    </div>


    <br>
    <div class="row">
        <div class="form-group col-xs-12 col-md-offset-3">
            <h4>Seleccione los usuarios del negocio</h4>

            <div class="secc1">
                <div class="titulo-secc1">SIN SELECCIONAR</div>
                <ul id="sortable1" class="connectedSortable">
                    @foreach ($usuarios_no_seleccionados as $usuario)
                    <li id="{{ $usuario->id }}" class="btn btn-success">{{ $usuario->username }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="secc2">
                <div class="titulo-secc2">SELECCIONADO</div>
                <ul id="sortable2" class="connectedSortable">
                    @foreach ($usuarios_seleccionados as $usuario)
                    <li id="{{ $usuario->id }}" class="btn btn-warning">{{ $usuario->username }}</li>
                    @endforeach
                </ul>
            </div>

        </div>

    </div>

    @include("fields.botones_button")

    {{ Form::hidden('id',null,array('class' => 'btn btn-primary','id' => 'id')) }}
    {{ Form::hidden('usuarios_seleccionados',$hidden_usuarios_seleccionados,array('class' => 'btn btn-primary','id' => 'usuarios_seleccionados')) }}


    <div id="mensaje"></div>
</div>
{{ Form::close() }}
@stop