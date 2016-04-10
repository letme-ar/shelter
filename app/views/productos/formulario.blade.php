@extends ('master')
@section ('script')
@include('productos.scripts')

@stop
@section ('content')
<h1> {{ $action }} un producto</h1>

<div class="page-header">
    {{ Form::model($model,$data_formulario, array('role' => 'form')) }}

    @include("insumos.insumos")

    {{ Field::text('proveedor','Nombre del proveedor', null, ['placeholder' => 'Introduce el nombre del proveedor'] ) }}

    <div class="form-group col-md-6">
        {{Form::label('precio_costo','Precio de costo del producto')}}
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">$</span>
            {{Form::text('precio_costo',null,array('placeholder' => 'Precio de costo del producto', 'class' => 'form-control', 'maxlength' => 6))}}
        </div>
    </div>

    <div class="form-group col-md-6">
        {{Form::label('precio_venta','Precio de venta del producto')}}
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">$</span>
            {{Form::text('precio_venta',null,array('placeholder' => 'Precio de venta del producto', 'class' => 'form-control', 'maxlength' => 6))}}
        </div>
    </div>

    {{ Field::text('stock','Stock inicial del producto', null, ['placeholder' => 'Introduce el stock inicial del producto','maxlength' => 6] ) }}

    @include("fields.botones_button")

    <div class="row">
        <div class="form-group col-md-12 style="margin-top: 20px">
            {{ Form::button($action. '',array('type' => 'button', 'class' => 'btn btn-primary', 'id' => 'btnAceptar')) }}
            <a href="{{ route('insumo.index') }}" class="btn btn-primary">Cancelar</a>
        </div>
    </div>
    <div id="mensaje"></div>
</div>
{{ Form::close() }}
@stop