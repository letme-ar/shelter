<script>

    $().ready(function()
    {

        $( "#vigencia_desde" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 3,
            buttonImageOnly: true,
            dateFormat: "dd/mm/yy",
            onClose: function( selectedDate ) {
                $( "#vigencia_hasta" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#vigencia_hasta" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 3,
            buttonImageOnly: true,
            dateFormat: "dd/mm/yy",
            onClose: function( selectedDate ) {
                $( "#vigencia_desde" ).datepicker( "option", "maxDate", selectedDate );
            }
        });

        $( "#vigencia_desde" ).mouseover(function() {
            $("#vigencia_desde").css("cursor","pointer");
        });

        $( "#vigencia_hasta" ).mouseover(function() {
            $("#vigencia_hasta").css("cursor","pointer");
        });

        $("#btnAceptar").click(function(){

            var datos = $('#frmServicio').serialize();
            var destino = "{{ Route('servicio.validarDatos') }}";
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
                        frmServicio.submit();
                    }
                }

            })

        });
    });

</script>