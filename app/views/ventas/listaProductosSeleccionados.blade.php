<script>

    $().ready(function(){

        $(".btnEliminar").click(function(){
            bloquear();
            var nro_registro = this.id;
            var datos = "nro_registro="+nro_registro;
            var destino = "{{ Route('venta.eliminarProducto') }}";
            $.ajax({
                type: "Post",
                url: destino,
                data: datos,
                async: true,
                success: function(respuesta){
                    desbloquear();
                    $("#ventas").html(respuesta);
                }

            })
        });


    });
    


</script>

<table id="myTableProductos" class="table">
    <thead>
    <tr>
        <th width="40%">Producto</th>
        <th>Cantidad a vender</th>
        <th>Precio unitario</th>
        <th>Precio de venta</th>
        @if($noMostrar == "")
            <th>Accion</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($lista as $key => $value)
    <tr>
        <td>{{ $value->producto->nombre }}</td>
        <td>{{ $value->cantidad }} </td>
        <td>${{ $value->precio_unitario }} </td>
        <td>${{ $value->precio_unitario * $value->cantidad}} </td>
        @if($noMostrar == "")
        <td>
            <input type="button" id="{{ $value->nro_registro }}" value="Eliminar" class="btn btn-default btn-sm btnEliminar" />
        </td>
        @endif
    </tr>
    @endforeach
    <tr>
        <th width="40%"></th>
        <th></th>
        <th>Precio total</th>
        <th>${{ $precio_total }}</th>
        <th></th>
    </tr>
    </tbody>
</table>