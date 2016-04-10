<script>

    function validarSiNumero(numero){
        var mensaje = "";
        if (!/^([0-9])*$/.test(numero))
            mensaje = "Debe ingresar un número correcto";
        return mensaje;
    }

    var cache = {};


    $().ready(function()
    {

        $( "#producto" ).autocomplete({
        minLength: 2,
        cache: false,
            source: function( request, response ) {
                var term = request.term;
                if ( term in cache ) {
                    response( cache[ term ] );
                    return;
                }
                $.getJSON( "{{ route('venta.darListaProductosAutocompletar')  }}", request, function( data, status, xhr ) {
                response( data );

                });
            }
        });

        $("#producto").focusout(function(){
            var nombre = $("#producto").val();
            var datos = "nombre="+nombre;
            var destino = "{{ Route('venta.productoSeleccionado') }}";
            $.ajax({
                type: "Post",
                url: destino,
                data: datos,
                async: false,
                success: function(respuesta){
                    if(respuesta == "No encontrado")
                        $("#stock").val(respuesta);
                    else
                    {
                        $("#stock").val(respuesta);
                        var nombre = $("#producto").val();
                        var datos = "nombre="+nombre;
                        var destino = "{{ Route('venta.darProductoCorrecto') }}";
                        $.ajax({
                            type: "Post",
                            url: destino,
                            data: datos,
                            async: true,
                            success: function(respuesta){
                                desbloquear();
                                $("#producto").val(respuesta);
                            }
                        });
                    }
                }

            })

        });

        $("#btnConfirmar").click(function(){
                    var nombre = $("#producto").val();
                    var cantidad = parseInt($("#cantidad").val());
                    var stock = parseInt($("#stock").val());
                    var mensaje = validarSiNumero(stock);
                    if($("#cantidad").val() == "")
                        darMensaje("divMensaje",200,300,"Debe ingresar una cantidad");
                    else if(cantidad <= 0)
                        darMensaje("divMensaje",200,300,"La cantidad debe ser positiva");
                    else if(mensaje)
                        darMensaje("divMensaje",200,400,mensaje);
                    else if(cantidad > stock)
                        darMensaje("divMensaje",200,400,"El valor maximo seleccionable es " + stock);
                    else
                    {
                        var datos = "nombre="+nombre+"&cantidad="+cantidad;
                        var destino = "{{ Route('venta.productoConfirmado') }}";
                        $.ajax({
                            type: "Post",
                            url: destino,
                            data: datos,
                            async: true,
                            success: function(respuesta){
                                desbloquear();
                                $("#ventas").html(respuesta);
                                $("#producto").focus();
                            }

                        });
                        $("#producto").val("");
                        $("#cantidad").val("");
                        $("#stock").val("");

                    }

        });

        $("#btnAceptar").click(function(){
            var datos = $('#frmVenta').serialize();
            var destino = "{{ Route('venta.validarDatos') }}";
            $.ajax({
                type: "Post",
                url: destino,
                data: datos,
                async: false,
                success: function(respuesta){
                    if(respuesta)
                    {
                        desbloquear();
                        darMensaje("divMensaje",300,500,respuesta);

                    }
                    else
                    {
                        frmVenta.submit();
                    }
                }

            })

        });




    });


</script>