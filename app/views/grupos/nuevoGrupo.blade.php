@extends ('master')
@section ('script')

<script>
    $().ready(function()
    {
        var cache = {};
        $( "#nombre" ).autocomplete({
        minLength: 2,
        source: function( request, response ) {
        var term = request.term;
        if ( term in cache ) {
        response( cache[ term ] );
        return;
        }
        $.getJSON( "{{ route('grupo.darListaGruposAutocompletar')  }}", request, function( data, status, xhr ) {
        cache[ term ] = data;
        response( data );
        });
        }
        });
    });
</script>
@stop
@section ('content')
<h1> Por favor, ingrese el nombre del grupo</h1>

<div class="page-header">
    {{ Form::open(array('route' => 'grupo.analizarGrupo','type' => 'POST')) }}
    <div class="row">
        <div class="form-group col-md-4 col-md-offset-4" style="margin-top: 20px;">
            {{ Form::label('nombre', 'Nombre del grupo') }}
            {{ Form::text('nombre', null, array('placeholder' => 'Introduce un nombre para el grupo', 'class' => 'form-control')) }}
        </div>
    </div>
   @include("fields.botones_submit")

    <div id="mensaje"></div>
</div>
    {{ Form::close() }}
    @stop