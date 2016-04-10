@extends ('master')
@section ('script')
@include('productos.scripts')

@stop
@section ('content')
<h1> Editar un producto</h1>

<div class="page-header">
    {{ Form::model($model,$data_formulario, array('role' => 'form')) }}

    @include("insumos.insumos")


    @include("fields.botones_submit")
</div>
<div id="mensaje"></div>
</div>
{{ Form::close() }}
@stop