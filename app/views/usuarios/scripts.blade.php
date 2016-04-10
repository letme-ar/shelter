<script>
    $().ready(function()
    {
        $("#btnAceptar").click(function(){
            var datos = $('#frmUser').serialize();
            var destino = "{{ Route('usuario.validarDatos') }}";
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
                        frmUser.submit();
                    }
                }

            })

        });

        $( "#sortable1, #sortable2" ).sortable({
            connectWith: ".connectedSortable",
            update: function(){
                $("#negocios_seleccionados").val($( "#sortable2" ).sortable( "toArray"));
                $('#sortable2 li').removeClass('btn-success').addClass('btn-warning');
            }
        }).disableSelection();

        $('#myTable').dataTable({
            "sDom":'T<"clear">lfrtip',
            "aaSorting": [ ],
            "language":{
                "url":'{{ URL::asset("assets/js/dataTables.lang.es.json") }}'

            }});

        $(".btnCambiarEstado").click(function(){
            var val = this.id.split("-");
            var id = val[0];
            var estado = val[1];
            $("#pregunta").html("¿Confirma que desea cambiar el estado del usuario?");
            $( "#pregunta" ).dialog({
                resizable: false,
                height:200,
                width: 400,
                modal: true,
                title: "Atencion",
                buttons: {
                    "Cambiar": function() {
                        bloquear();
                        $( this ).dialog( "close" );
                        $.ajax({
                            type: "POST",
                            data: "id="+id+"&estado="+estado,
                            url : '{{ route("usuario.cambiarEstado")}}',
                            async: true,
                            success: function(respuesta)
                            {
                                desbloquear();
                                if(respuesta == "Ok")
                                {
                                    $("#pregunta").html("Se ha cambiado de estado al usuario");
                                    $( "#pregunta" ).dialog({
                                        resizable: false,
                                        height:200,
                                        width: 400,
                                        modal: true,
                                        buttons:
                                        {
                                            "Aceptar": function() {
                                                $( this ).dialog( "close" );
                                                $(location).attr('href',"{{ route('usuario.index') }}");

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
        $(".btnReiniciarPassword").click(function(){
            var id = this.id;
            $("#pregunta").html("¿Confirma que desea reiniciar el password del usuario?");
            $( "#pregunta" ).dialog({
                resizable: false,
                height:200,
                width: 400,
                modal: true,
                title: "Atencion",
                buttons: {
                    "Reiniciar": function() {
                        bloquear();
                        $( this ).dialog( "close" );
                        $.ajax({
                            type: "POST",
                            data: "id="+id,
                            url : '{{ route("usuario.reiniciarPassword")}}',
                            async: true,
                            success: function(respuesta)
                            {
                                desbloquear();
                                if(respuesta == "Ok")
                                {
                                    $("#pregunta").html("Se ha reiniciado el password del usuario");
                                    $( "#pregunta" ).dialog({
                                        resizable: false,
                                        height:200,
                                        width: 400,
                                        modal: true,
                                        buttons:
                                        {
                                            "Aceptar": function() {
                                                $( this ).dialog( "close" );
                                                $(location).attr('href',"{{ route('usuario.index') }}");

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



