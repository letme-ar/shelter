@extends ('master')
@section ('script')
@include('productos.scripts')

@stop

@section ('content')
<h2> Agregar stock al producto {{ $producto->nombre }}</h2>

<div class="page-header">
    {{ Form::model($model,$data_formulario, array('role' => 'form')) }}

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

    {{ Field::text('stock','Stock que se agrega del producto', null, ['placeholder' => 'Introduce el stock que se agrega al producto','maxlength' => 6] ) }}

    {{ Field::text('comentario','Comentario del ajuste', null, ['placeholder' => 'Introduce el comentario de por que se realiza el ajuste','maxlength' => 100] ) }}


    @include("fields.botones_button")

    {{ Form::input("hidden","nombre",$producto->nombre) }}
    {{ Form::input("hidden","id",$producto->id) }}


    @include("productos.listadoStock")
    <div id="mensaje"></div>
</div>
{{ Form::close() }}
@stop