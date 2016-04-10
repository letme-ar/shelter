<script>
    $().ready(function()
    {



        $(".btnConfirmar").click(function(){
            var id = this.id;
            var cantidad = parseInt($("#cantidad").val());
            var cantidad_maxima = parseInt($("#cantidad_maxima").val());
            var precio_actual = parseInt($("#precio_actual").val());
            var mensaje = validarSiNumero(cantidad);
            if(mensaje)
                alert(mensaje);
            else if(cantidad > cantidad_maxima)
                alert("El valor maximo seleccionable es " + cantidad_maxima);
            else
            {
                var datos = "id="+id+"&cantidad="+cantidad+"&precio_actual="+precio_actual;
                var destino = "{{ Route('venta.productoConfirmado') }}";
                $.ajax({
                    type: "Post",
                    url: destino,
                    data: datos,
                    async: true,
                    success: function(respuesta){
                        desbloquear();
                        $("#ventas").html(respuesta);
                        $('#popup').modal('hide');
                    }

                })

            }

        });
    });

</script>

{{ Form::hidden('precio_actual',$precio_actual,array('id' => 'precio_actual')) }}
{{ Form::hidden('cantidad_maxima',$disponibilidad,array('id' => 'cantidad_maxima')) }}
<table id="myTableProductos" class="table">
    <thead>
    <tr>
        <th>Producto</th>
        <th>Precio actual</th>
        <th>Disponibilidad</th>
        <th>Cantidad a vender</th>
        @if($noMostrar==""))
        <th>Accion</th>
        @endif
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $producto }}</td>
        <td>${{ $precio_actual }}</td>
        <td>{{ $disponibilidad }}</td>
        <td>{{ Form::text('cantidad', "", array('placeholder' => 'Cantidad','id' => 'cantidad','maxlength' => '5')) }} </td>
        @if($noMostrar==""))
        <td>
            <input type="button" value="Seleccionar" id="{{ $id }}" class="btn btn-default btn-sm btnConfirmar" />
        </td>
        @endif
    </tr>
    </tbody>
</table>