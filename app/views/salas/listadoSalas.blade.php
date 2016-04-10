<script>
    $().ready(function()
    {
        $(".btnEliminar").click(function(){
            bloquear();
            var id = this.id;
            $.ajax({
                type: "POST",
                data: "sala="+id,
                url : '{{ route("negocio.borrarSala")}}',
                success: function(respuesta)
                {
                    desbloquear();
                    $("#divSalas").html(respuesta);
                }
            });

        });
    });
</script>
<div class="row" style="margin-bottom:20px;">
    <h2>Listado de salas</h2>

</div>
<table class="table">
    <thead>
    <tr>
        <th>Sala</th>
        <th>Principal</th>
        <th>Eliminar</th>
    </tr>
    </thead>
    <tbody>
    @foreach($salas as $value)
        <tr>
            <td>{{ $value->sala }}</td>
            <td>{{ Form::radio('principal_sala', $value->sala,$value->principal) }}</td>
            <td>
                <input type="button" value="Eliminar" id="{{ $value->sala }}" class="btn btn-danger btn-sm btnEliminar" />
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
