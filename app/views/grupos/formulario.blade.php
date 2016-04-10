@extends ('master')
@section ('script')
@include('grupos.scripts')

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
    {{ Form::model($model,$data_formulario, array('role' => 'form')) }}

    {{ Field::text('nombre','Nombre del grupo', null, ['placeholder' => 'Introduce el nombre del grupo','id' => 'nombre'] ) }}

    {{ Field::select('id_estilo','Estilo del grupo',$combo_estilos,null,['id' => 'id_estilo']) }}

    {{ Field::text('facebook','Facebook del grupo', null, ['placeholder' => 'Introduce el facebook del grupo'] ) }}

    {{ Field::text('twitter','Twitter del grupo', null, ['placeholder' => 'Introduce el twitter del grupo'] ) }}

    {{ Field::text('integrantes','Integrantes del grupo', null, ['placeholder' => 'Introduce los integrantes del grupo'] ) }}

    {{ Field::text('web','Web del grupo', null, ['placeholder' => 'Introduce la web del grupo'] ) }}

    @if($id_negocio)
    <div class="form-inline ">
        <div class="form-group col-md-12">
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
                {{ Form::button('Agregar',array('type' => 'button', 'class' => 'btn btn-success btn-sm','id' => 'btnAgregarContacto')) }}
            </div>
        </div>
    </div>
    @endif

    <div id="divContactos">{{ $contactos }}</div>


    @include("fields.botones_button")

    <div class="form-group col-md-4" style="margin-top: 20px">
        {{ Form::hidden('id',null,array('class' => 'btn btn-primary','id' => 'id')) }}
        {{ Form::hidden('id_negocio',$id_negocio,array('class' => 'btn btn-primary','id' => 'id')) }}
    </div>

    <div id="mensaje"></div>
</div>
{{ Form::close() }}
@stop