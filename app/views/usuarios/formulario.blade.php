@extends ('master')
@section ('script')

@include('usuarios.css')
@include('usuarios.scripts')

@stop
@section ('content')
<h1> {{ $action }} un usuario</h1>

<div class="page-header">
    {{ Form::model($model,$data_formulario, array('role' => 'form')) }}

    {{ Field::text('username','Usuario', null, ['placeholder' => 'Introduce el usuario'] ) }}

    {{ Field::select('tipo_usuario','Tipo de usuario',$combo_tipos_usuarios,null,['id' => 'tipo_usuario']) }}

    {{ Field::text('nombre','Nombre', null, ['placeholder' => 'Introduce el nombre'] ) }}

    {{ Field::text('apellido','Apellido', null, ['placeholder' => 'Introduce el apellido'] ) }}


    <div class="row">
        <div class="form-group col-xs-12 col-md-offset-3">
            <h4>Seleccione los negocios del usuario</h4>

            <div class="secc1">
                <div class="titulo-secc1">SIN SELECCIONAR</div>
                <ul id="sortable1" class="connectedSortable">
                    @foreach ($negocios_no_seleccionados as $negocio)
                    <li id="{{ $negocio->id }}" class="btn btn-success">{{ $negocio->nombre }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="secc2">
                <div class="titulo-secc2">SELECCIONADO</div>
                <ul id="sortable2" class="connectedSortable">
                    @foreach ($negocios_seleccionados as $n)
                    <li id="{{ $n->id }}" class="btn btn-warning">{{ $n->nombre }}</li>
                    @endforeach
                </ul>
            </div>

        </div>

    </div>
    <br>

    @include("fields.botones_button")
    {{ Form::hidden('id',null,array('class' => 'btn btn-primary','id' => 'id')) }}
    {{ Form::hidden('negocios_seleccionados',$hidden_negocios_seleccionados,array('class' => 'btn btn-primary','id' => 'negocios_seleccionados')) }}

    <div id="mensaje"></div>
</div>
{{ Form::close() }}
@stop