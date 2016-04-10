@extends ('master')
@section ('script')
<script>
    $().ready(function()
    {
        $('#myTable').dataTable({
                        "sDom":'T<"clear">lfrtip',
                        "aaSorting": [ ],
                        "language":{
                            "url":'{{ URL::asset("assets/js/dataTables.lang.es.json") }}'

                        }});

        $(".btnEliminar").click(function(){
            var id = this.id;
            $( "#pregunta" ).dialog({
                resizable: false,
                height:200,
                width: 400,
                modal: true,
                title: "Atencion",
                buttons: {
                    "Eliminar": function() {
                        $( this ).dialog( "close" );
                        $.ajax({
                            type: "POST",
                            data: "id="+id,
                            url : '{{ route("grupo.borrar")}}',
                            success: function(respuesta)
                            {
                                if(respuesta == "Ok")
                                {
                                    $("#pregunta").html("Se ha eliminado el grupo");
                                    $( "#pregunta" ).dialog({
                                        resizable: false,
                                        height:200,
                                        width: 400,
                                        modal: true,
                                        buttons:
                                        {
                                            "Aceptar": function() {
                                                $( this ).dialog( "close" );
                                                $(location).attr('href',"{{ route('grupo.index') }}");

                                            }
                                        }
                                    });

                                }
                            }
                        });
                    },
                    Cancelar: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        });
    });
</script>


@stop
@section ('title') Listado de grupos - Shelter @stop
@section ('content')
<div class="row" style="margin-bottom:20px;">
    <div class="col-md-6">
        <h2>Listados de grupos</h2>
    </div>
    <div class="col-md-6" style="text-align:right; padding-top:30px;"><a href="{{ route('grupo.nuevoGrupo') }}" class="btn btn-primary">Agregar</a>
    </div>
</div>
<table id="myTable" class="table">
    <thead>
    <tr>
        <th>Nombre</th>
        <th class="celular">Nombre contacto principal</th>
        <th class="celular">Telefono contacto principal</th>
        <th class="celular">Estilo</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($grupos as $key => $value)
            @if($value->eliminado != 1)
                <tr>
                <td>{{ $value->nombre }}</td>
                <td class="celular">{{ $value->nombrecontacto }}</td>
                <td class="celular">{{ $value->telefonocontacto }}</td>
                <td class="celular">{{ $value->estilo }}</td>
            @else
                <tr style="background-color: #808080;">
                <td><strike>{{ $value->nombre }}</strike></td>
                <td class="celular"><strike>{{ $value->nombrecontacto }} </strike></td>
                <td class="celular"><strike>{{ $value->telefonocontacto }}</strike></td>
                <td class="celular"><strike>{{ $value->estilo }}</strike></td>
            @endif
        <td>
        @if($value->eliminado != "1")
            <a href="{{ route('grupo.edit', $value->id."-".$value->id_negocio) }}" class="btn btn-success btn-sm">
                Editar
            </a>
            <input type="button" value="Eliminar" id="{{ $value->id }}" class="btn btn-danger btn-sm btnEliminar" />
        @else
            Eliminado
        @endif
        </td>

    </tr>
    @endforeach
    </tbody>
</table>
<div id="pregunta" style="display:none">¿Confirma que desea eliminar el grupo?</div>

@stop