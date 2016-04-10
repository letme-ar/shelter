<script>
    $().ready(function()
    {
        $("#id_provincia").multipleSelect({
            single: true,
            filter: true
        });
        $("#id_provincia").change(function(){
            $.ajax({
                type : 'POST',
                url : '{{ Request::root() }}/negocio/darComboLocalidades',
                data : 'id_provincia=' + $("#id_provincia").val(),
                async: false,
                cache: true,
                success : function(respuesta) {
                    $("#div_localidades").html(respuesta);
                }
            });
        });

        $("#btnAgregarTelefono").click(function(){
            var telefono = $("#telefono").val();
            var resultado = validarTelefono(telefono);
            //            alert(nombre);
            if(!telefono)
            {
                desbloquear();
                darMensaje("mensaje",200,400,"Debe completar el telefono");
            }
            else if(resultado)
            {
                desbloquear();
                darMensaje("mensaje",200,400,resultado);
            }
            else
            {
                var destino = "{{ Route('negocio.agregarTelefono') }}";
                var datos = "telefono="+telefono;
                //var respuesta = peticionAjax(datos,"post",destino);

                $.ajax({
                    url:  destino,
                    type: "post",
                    data: datos,
                    async:  true,
                    success:function(respuesta){
                        desbloquear();
                        $("#divTelefonos").html(respuesta);
                        $("#telefono").val("");
                    }
                });
            }
        });

        $("#btnAgregarSala").click(function(){
            var sala = $("#sala").val();
            //            alert(nombre);
            if(!sala)
            {
                desbloquear();
                darMensaje("mensaje",200,400,"Debe completar la sala");
            }
            else
            {
                var destino = "{{ Route('negocio.agregarSala') }}";
                var datos = "sala="+sala;
                //var respuesta = peticionAjax(datos,"post",destino);

                $.ajax({
                    url:  destino,
                    type: "post",
                    data: datos,
                    async:  true,
                    success:function(respuesta){
                        desbloquear();
                        $("#divSalas").html(respuesta);
                        $("#sala").val("");
                    }
                });
            }
        });

        $("#btnAceptar").click(function(){
            var datos = $('#frmNegocio').serialize();
            var destino = "{{ Route('negocio.validarDatos') }}";
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
                        frmNegocio.submit();
                    }
                }

            })

        });

        $( "#sortable1, #sortable2" ).sortable({
            connectWith: ".connectedSortable",
            update: function(){
                $("#usuarios_seleccionados").val($( "#sortable2" ).sortable( "toArray"));
                $('#sortable2 li').removeClass('btn-success').addClass('btn-warning');
            }
        }).disableSelection();


        $('#myTable').dataTable({
            "sDom":'T<"clear">lfrtip',
            "aaSorting": [ ],
            "language":{
                "url":'{{ URL::asset("assets/js/dataTables.lang.es.json") }}'

            }});

        $(".btnEliminar").click(function(){

            var val = this.id.split("-");
            var id = val[0];
            var estado = val[1];
            $( "#pregunta" ).dialog({
                resizable: false,
                height:200,
                width: 400,
                modal: true,
                title: "Atencion",
                buttons: {
                    "Eliminar": function() {
                        $( this ).dialog( "close" );
                        $.ajax({
                            type: "POST",
                            data: "id="+id+"&estado="+estado,
                            url : '{{ route("negocio.desactivar")}}',
                            success: function(respuesta)
                            {
                                if(respuesta == "Ok")
                                {
                                    $("#pregunta").html("Se ha desactivado el negocio");
                                    $( "#pregunta" ).dialog({
                                        resizable: false,
                                        height:200,
                                        width: 400,
                                        modal: true,
                                        buttons:
                                        {
                                            "Aceptar": function() {
                                                $( this ).dialog( "close" );
                                                $(location).attr('href',"{{ route('negocio.index') }}");

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

