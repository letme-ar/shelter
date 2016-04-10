<script>
    $().ready(function()
    {
        $(".btnEliminar").click(function(){
            var id = this.id;
            $.ajax({
                type: "POST",
                data: "id="+id,
                url : '{{ route("grupo.borrarContacto")}}',
                success: function(respuesta)
                {
                    $("#divContactos").html(respuesta);
                }
            });

        });
    });
</script>
<div class="row" style="margin-bottom:20px;">
    <div class="col-md-6"><h2>Listado de contactos</h2>
    </div>
</div>
<table id="myTable" class="table">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Principal</th>
        <th>Eliminar</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contactos as $key => $value)
        <tr>
            <td>{{ $value->nombrecontacto }}</td>
            <td>{{ $value->telefonocontacto }}</td>
            <td>{{ Form::radio('principal', $value->nro_integrante,$value->principal) }}</td>
            @if($permitir_modificar)
            <td>
                <input type="button" value="Eliminar" id="{{ $value->nro_integrante }}" class="btn btn-danger btnEliminar btn-sm" />
            </td>
            @else
            <td>No puede eliminar por no ser el usuario creador</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
