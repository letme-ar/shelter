<script>
    $().ready(function()
    {
        $(".btnEliminar").click(function(){
            bloquear();
            var id = this.id;
            $.ajax({
                type: "POST",
                data: "telefono="+id,
                url : '{{ route("negocio.borrarTelefono")}}',
                async: true,
                success: function(respuesta)
                {
                    desbloquear();
                    $("#divTelefonos").html(respuesta);
                }
            });

        });
    });
</script>
<div class="row" style="margin-bottom:20px;">
    <h2>Listado de telefonos</h2>
</div>
<table class="table">
    <thead>
    <tr>
        <th>Telefono</th>
        <th>Principal</th>
        <th>Eliminar</th>
    </tr>
    </thead>
    <tbody>
    @foreach($telefonos as $value)
        <tr>
            <td>{{ $value->telefono }}</td>
            <td>{{ Form::radio('principal_telefono', $value->telefono,$value->principal) }}</td>
            <td>
                <input type="button" value="Eliminar" id="{{ $value->telefono }}" class="btn btn-danger btn-sm btnEliminar" />
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
