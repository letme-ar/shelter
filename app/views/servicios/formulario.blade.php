@extends ('master')
@section ('script')
@include('servicios.scripts')

@stop
@section ('content')
<h1> {{ $action }} un servicio</h1>

<div class="page-header">
    {{ Form::model($model,$data_formulario, array('role' => 'form')) }}

    @include("insumos.insumos")

    {{ Field::text('vigencia_desde','Inicio de vigencia del servicio', $model->vigencia_desde_title, ['placeholder' => 'Introduce la fecha de inicio de la vigencia', 'id' => 'vigencia_desde','readOnly' => 'readOnly'] ) }}

    {{ Field::text('vigencia_hasta','Fin de vigencia del servicio', $model->vigencia_desde_title, ['placeholder' => 'Introduce la fecha de fin de la vigencia', 'id' => 'vigencia_hasta','readOnly' => 'readOnly'] ) }}


    <div class="form-group col-md-6">
        {{Form::label('precio_venta','Precio de venta del servicio')}}
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">$</span>
            {{Form::text('precio_venta',null,array('placeholder' => 'Precio de venta del servicio', 'class' => 'form-control', 'maxlength' => 6))}}
        </div>
    </div>
    @include("fields.botones_button")
    <div id="mensaje"></div>
</div>
{{ Form::close() }}
@stop