<script>
    $().ready(function()
    {
        $(".btnSeleccionar").click(function(){
            var id = this.id;
            var datos = "id="+id;
            var destino = "{{ Route('venta.productoSeleccionado') }}";
            $.ajax({
                type: "Post",
                url: destino,
                data: datos,
                async: true,
                success: function(respuesta){
                    desbloquear();
                    $("#resultados").html(respuesta);
                }

            })
        });
    });

</script>

<table id="myTableProductos" class="table">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Stock total</th>
        <th>Accion</th>
    </tr>
    </thead>
    <tbody>
    @foreach($productos as $key => $value)
    <tr>
        <td>{{ $value->nombre }}</td>
        <td>{{ $value->stock_total }}</td>
        <td>
            @if($value->stock_total > 0)
            <input type="button" value="Seleccionar" id="{{ $value->id }}" class="btn btn-default btn-sm btnSeleccionar" />
            @else
                <label>Sin stock</label>
            @endif
        </td>
    </tr>
    @endforeach
    </tbody>
</table>