<script>
    $().ready(function()
    {
        if($("#nombre").val() == "")
            $("#nombre").prop("readonly",false);
        else
            $("#nombre").prop("readonly",true);

        $("#btnAceptar").click(function(){
            var datos = $('#frmGrupo').serialize();
            var destino = "{{ Route('grupo.validarDatos') }}";
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
                        frmGrupo.submit();
                    }
                }

            })

        });
        $("#btnAgregarContacto").click(function(){
            var nombre = $("#nombrecontacto").val();
            var telefono = $("#telefonocontacto").val();
            var resultado = validarTelefono(telefono);
//            alert(nombre);
            if(!nombre)
            {
                desbloquear();
                darMensaje("mensaje",200,400,"Debe completar el nombre del contacto");
            }
            else if(!telefono)
            {
                desbloquear();
                darMensaje("mensaje",200,400,"Debe completar el telefono del contacto");
            }
            else if(resultado)
            {
                desbloquear();
                darMensaje("mensaje",200,400,resultado);
            }
            else
            {
                var destino = "{{ Route('grupo.agregarContacto') }}";
                var datos = "nombrecontacto="+nombre+"&telefonocontacto="+telefono;
                //var respuesta = peticionAjax(datos,"post",destino);

                $.ajax({
                    url:  destino,
                    type: "post",
                    data: datos,
                    async:  true,
                    success:function(respuesta){
                        desbloquear();
                        $("#divContactos").html(respuesta);
                        $("#nombrecontacto").val("");
                        $("#telefonocontacto").val("");
                    }
                });
            }
        });
    });
</script>



