   function darMensaje(div, alto, ancho,mensaje)
    {
        $("#"+div).html(mensaje);
        $("#"+div).dialog({
            resizable: false,
            height:alto,
            width: ancho,
            title: "Atención",
            modal: true,
            buttons: {
                "Aceptar": function() {
                    $( this ).dialog( "close" );
                    $('#'+div).dialog('destroy');
                }
            }
        }).find('.ui-dialog-titlebar-close').hide();

    }

   function validarTelefono(telefono){
       var expresionRegular1=/^([0-9]+){9}$/;//<--- con esto vamos a validar el numero
       var expresionRegular2=/\s/;//<--- con esto vamos a validar que no tenga espacios en blanco

       if(expresionRegular2.test(telefono))
           return 'Error existen espacios en blanco';
       else if(!expresionRegular1.test(telefono))
           return 'Numero de telefono incorrecto';
       else
           return "";
   }


   /*function peticionAjax(datos, tipo, destino){
       $.ajax({
           url:  destino,
           type: tipo,
           data: datos,
           async:  true,
           beforeSend: function(objeto){
               alert("Adiós, me voy a ejecutar");
           },
           complete: function(objeto, exito){
               alert("Me acabo de completar")
               if(exito=="success"){
                   alert("Y con éxito");
               }
           },

           error: function() { alert('Se ha producido un error'); }
       });
   }*/


   /*Utils = {};
   Utils.peticionAjax = function(data,url,callback){

       $.ajax({
           data:data,
           url:url,
           type:'post',
           success:function(response){
               callback(response);
           }

       });
   }*/



