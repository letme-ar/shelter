<script>

    $().ready(function()
    {
        $("#btnAceptar").click(function(){
            var datos = $('#frmProducto').serialize();
            var destino = "{{ Route('producto.validarDatos') }}";
            $.ajax({
                type: "Post",
                url: destino,
                data: datos,
                async: true,
                success: function(respuesta){
                    if(respuesta)
                    {
                        desbloquear();
                        darMensaje("mensaje",300,500,respuesta);

                    }
                    else
                    {
                        frmProducto.submit();
                    }
                }

            })

        });
    });

</script>