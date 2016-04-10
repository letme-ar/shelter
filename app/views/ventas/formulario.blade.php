@extends ('master')
@section ('script')
@include('ventas.scripts')

@stop
@section ('content')
<h1> Registrar una venta</h1>

<div class="page-header">


    {{ Form::model($venta,$data_formulario, array('role' => 'form')) }}

    <div class="col-md-12" style="padding: 0px">
    {{ Field::select('id_grupo','Grupo', $combo_grupos, null ) }}
    </div>
    <div class="form-inline">
     <div class="form-group col-md-4">
            {{ Form::label('producto', 'Producto',['for'=>'exampleInputEmail3']) }}
            {{ Form::text('producto', null, array('id' => 'producto','placeholder' => 'Introduce el producto', 'class' => 'form-control')) }}
     </div>
     <div class="form-group col-md-2">
            {{ Form::label('stock', 'Stock',['for'=>'exampleInputEmail3']) }}
            {{ Form::text('stock', null, array('id' => 'stock','placeholder' => 'stock disponible', 'class' => 'form-control','readOnly' => 'readOnly')) }}
     </div>
     <div class="form-group col-md-2">
            {{ Form::label('cantidad', 'Cantidad',['for'=>'exampleInputEmail3']) }}
            {{ Form::text('cantidad', null, array('placeholder' => 'Introduce la cantidad', 'class' => 'form-control')) }}
     </div>
     <div class="form-group" style="height: 59px;">
            {{ Form::button('Agregar producto',array('type' => 'button', 'class' => 'btn btn-success btn-sm', 'id' => 'btnConfirmar','style' => "margin-bottom: 0px; margin-top: 25px")) }}
     </div>
   </div>

    <div id="ventas"></div>

    @include("fields.botones_button")

    <div id="divMensaje"></div>
</div>
{{ Form::close() }}

@stop
