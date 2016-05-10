<script>
$(document).ready(function() {
    console.log("hola");

    var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");

    var hoy = new Date();
    var mes = hoy.getMonth()+1;
    $('#fecha_actual').text(diasSemana[hoy.getDay()]+" "+hoy.getDate()+"/"+mes+"/"+hoy.getFullYear());
    $("#hidden_fecha").val(hoy.getTime());

    $("#anterior").click(function(){
        $('#fecha_actual').text(darAyer());
        getEventData();
    });

    $("#siguiente").click(function(){
        $('#fecha_actual').text(darManana());
        getEventData();

    });

    /*
    var $calendario_celular = document.querySelector("#calendario_celular");
    var calendario_celular = new Hammer($calendario_celular);


    calendario_celular.on("panleft",function(){
        $('#fecha_actual').text(darManana());
        getEventData();
    });

    calendario_celular.on("panright",function(){
        $('#fecha_actual').text(darAyer());
        getEventData();
    });
    */



    if(document.documentElement.clientWidth > 780)
    {
        var id = $("#id_sala").val();
        var destino = "{{ Route('calendario.validarVencidas') }}";
        var datos = "id_sala="+id;
        $.ajax({
            url:  destino,
            type: "post",
            data: datos,
            async: false,

            success:function(respuesta)
            {
//                console.log(respuesta);
                if(respuesta != "")
                {
                    $("#mensaje").html(respuesta);
                    $("#mensaje").dialog({
                        resizable: false,
                        height:400,
                        width: 800,
                        title: "Atención",
                        modal: true,
                        buttons: {
                            "Lo hare luego": function() {
                                $( this ).dialog( "close" );
                            },
                            "Aceptar": function() {

                                var data = "";
                                $( this ).dialog( "close" );

                                $( ".id_estilo" ).each(function() {
                                    if(data == "")
                                        data += $( this ).attr("id")+"="+$( this ).val();
                                    else
                                        data += "&"+$( this ).attr("id")+"="+$( this ).val();

                                });
                                data += "&id_sala="+$("#id_sala").val();
                                var url = "{{ Route('calendario.actualizarGanadasPerdidas')}}"; // El script a dónde se realizará la petición.
                                $.ajax({
                                    type: "POST",
                                    url: url,
                                    data: data, // Adjuntar los campos del formulario enviado.
                                    success: function()
                                    {
                                        darMensaje("mensaje2",300,300,"Guardado correctamente");
                                        $(location).attr('href',"{{ route('calendario.index') }}");
                                    }
                                });

                                return false;                            }

                        }
                    }).find('.ui-dialog-titlebar-close').hide();
                }


            }
        });
    }

    $("#id_sala").change(function(){
        var id = $("#id_sala").val();
        var destino = "{{ Route('calendario.cambiarSala') }}";
        var datos = "id_sala="+id;
        $.ajax({
            url:  destino,
            type: "post",
            data: datos,
            async: true,
            success:function(respuesta)
            {
                $.blockUI({ message: '<h1><img src="{{URL::asset("images/cargando.gif")}}" /> Cargando...</h1>' });
                location.href = "{{Route("calendario.index")}}";
            }
        });
    });

    $("#id_grupo").change(function(){
        var id = $("#id_grupo").val();
        var destino = "{{ Route('calendario.darContactoPrincipal') }}";
        var datos = "id_grupo="+id;
        $.ajax({
            url:  destino,
            type: "post",
            data: datos,
            async: true,
            success:function(respuesta)
            {
                $("#contacto").val(respuesta);
            }
        });
    });



    var respuesta = [];
    var $calendar = $('#calendar');
   var id = 10;

   $calendar.weekCalendar({
      timeslotsPerHour : 2,
      allowCalEventOverlap : true,
      overlapEventsSeparate: true,
      firstDayOfWeek : 1,
      businessHours :{start: 0, end: 24, limitDisplay: true },
      daysToShow : 7,
      height : function($calendar) {
         return $(window).height() - $("h1").outerHeight() - 1;
      },
      eventRender : function(calEvent, $event) {
         if (calEvent.end.getTime() < new Date().getTime()) {
            $event.css("backgroundColor", "#aaa");
            $event.find(".wc-time").css({
               "backgroundColor" : "#999",
               "border" : "1px solid #888"
            });
         }
      },
      draggable : function(calEvent, $event) {
         return calEvent.readOnly != true;
      },
      resizable : function(calEvent, $event) {
         return calEvent.readOnly != true;
      },
      eventNew : function(calEvent, $event) {
         var $dialogContent = $("#event_edit_container");
         resetForm($dialogContent);
         var id_grupo = $dialogContent.find("select[name='id_grupo']").val();
         var id_servicio = $dialogContent.find("select[name='id_servicio']").val();
         var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
         var titleField = $dialogContent.find("input[name='title']");
         var bodyField = $dialogContent.find("input[name='body']");
         var contactoField = $dialogContent.find("input[name='contacto']");
         var id_estado_reserva = $dialogContent.find("input[name='id_estado_reserva']").val(1);


          $dialogContent.dialog({
            modal: true,
            title: "Nueva reserva",
            width: "750px",
            resizable: false,
             close: function() {
               $dialogContent.dialog("destroy");
               $dialogContent.hide();
               $('#calendar').weekCalendar("removeUnsavedEvents");
            },
            buttons: {
                "Guardar" : function() {

                calEvent.start = new Date(startField.val());
                calEvent.end = new Date(endField.val());
                calEvent.title = titleField.val();
                calEvent.body = bodyField.val();
                calEvent.id_grupo = $("#id_grupo").val();
                calEvent.id_servicio = $("#id_servicio").val();
                calEvent.nombre_grupo = $("#id_grupo :selected").text();
                calEvent.contacto = contactoField.val();
                calEvent.id_estado_reserva = 1;



                    var anio = calEvent.start.getFullYear();
                    var mes = calEvent.start.getMonth()+1;
                    var dia = calEvent.start.getDate();
                    var hora_inicio = calEvent.start.getHours();
                    var minuto_inicio = calEvent.start.getMinutes();
                    var hora_fin = calEvent.end.getHours();
                    var minuto_fin = calEvent.end.getMinutes();
                    var fecha = dia+"/"+mes+"/"+anio;

                    var id_sala = $("#id_sala").val();
                    var start = calEvent.start;
                    var end = endField.val();
                    var title = titleField.val();
                    var body = bodyField.val();
                    var id_grupo = $("#id_grupo").val();
                    var id_servicio = $("#id_servicio").val();
                    var id_estado_reserva = 1;
                    var destino = "{{ Route('calendario.nuevoEvento') }}";
                    var datos = "id_sala="+id_sala+"&fecha="+fecha+"&hora_inicio="+hora_inicio+"&minuto_inicio="+minuto_inicio+"&hora_fin="+hora_fin+"&minuto_fin="+minuto_fin+"&title="+title+"&comentario="+body+"&id_grupo="+id_grupo+"&id_estado_reserva="+id_estado_reserva+"&id_servicio="+id_servicio;

                    var destino = "{{ Route('calendario.validarDatosCalendario') }}";
                    $.ajax({
                        type: "Post",
                        url: destino,
                        data: datos,
                        async: true,
                        success: function(respuesta){
                            if(respuesta)
                            {
                                darMensaje("popup_mensaje",300,500,respuesta);
                            }
                            else
                            {
                                var datos = "id_sala="+id_sala+"&anio="+anio+"&mes="+mes+"&dia="+dia+"&hora_inicio="+hora_inicio+"&minuto_inicio="+minuto_inicio+"&hora_fin="+hora_fin+"&minuto_fin="+minuto_fin+"&title="+title+"&comentario="+body+"&id_grupo="+id_grupo+"&id_estado_reserva="+id_estado_reserva+"&id_servicio="+id_servicio;
                                var destino = "{{ Route('calendario.nuevoEvento') }}";
                                calEvent.id = respuesta;
                                $calendar.weekCalendar("removeUnsavedEvents");
                                $calendar.weekCalendar("updateEvent", calEvent);
                                var id = $.ajax({
                                    url:  destino,
                                    type: "post",
                                    dataType: "json",
                                    data: datos,
                                    async: true,
                                    success:function(respuesta)
                                    {
                                        calEvent.id = respuesta;
                                        $calendar.weekCalendar("removeUnsavedEvents");
                                        $calendar.weekCalendar("updateEvent", calEvent);
                                    }
                                });
                                $dialogContent.dialog("close");
                            }
                        }

                    });

                    /*
                    var id = $.ajax({
                        url:  destino,
                        type: "post",
                        dataType: "json",
                        data: datos,
                        async: true,
                        success:function(respuesta)
                        {
                            calEvent.id = respuesta;
                            $calendar.weekCalendar("removeUnsavedEvents");
                            $calendar.weekCalendar("updateEvent", calEvent);
                        }
                    });
                    */

//                    $dialogContent.dialog("close");


               },
               Cerrar : function() {
                  $dialogContent.dialog("close");
               }
            }
         }).show();

         $dialogContent.find(".date_holder").text($calendar.weekCalendar("formatDate", calEvent.start));
         setupStartAndEndTimeFields(startField, endField, calEvent, $calendar.weekCalendar("getTimeslotTimes", calEvent.start));

      },
      eventDrop : function(calEvent, $event) {
        var anio = calEvent.start.getFullYear();
      var mes = calEvent.start.getMonth()+1;
      var dia = calEvent.start.getDate();
      var hora_inicio = calEvent.start.getHours();
      var minuto_inicio = calEvent.start.getMinutes();
      var hora_fin = calEvent.end.getHours();
      var minuto_fin = calEvent.end.getMinutes();

      var id_sala = $("#id_sala").val();
      var id_grupo = calEvent.id_grupo;
      var destino = "{{ Route('calendario.actualizarEvento') }}";
      var datos = "id="+calEvent.id+"&id_sala="+id_sala+"&anio="+anio+"&mes="+mes+"&dia="+dia+"&hora_inicio="+hora_inicio+"&minuto_inicio="+minuto_inicio+"&hora_fin="+hora_fin+"&minuto_fin="+minuto_fin+"&id_grupo="+id_grupo;
      $.ajax({
          url:  destino,
          type: "post",
          dataType: "json",
          data: datos,
          async: true,
          success:function(respuesta)
          {
              calEvent.id_estado_reserva = respuesta;
          }
      });
      },
      eventResize : function(calEvent, $event) {
          var anio = calEvent.start.getFullYear();
          var mes = calEvent.start.getMonth()+1;
          var dia = calEvent.start.getDate();
          var hora_inicio = calEvent.start.getHours();
          var minuto_inicio = calEvent.start.getMinutes();
          var hora_fin = calEvent.end.getHours();
          var minuto_fin = calEvent.end.getMinutes();

          var id_sala = $("#id_sala").val();
          var id_grupo = calEvent.id_grupo;
          var destino = "{{ Route('calendario.actualizarEvento') }}";
          var datos = "id="+calEvent.id+"&id_sala="+id_sala+"&anio="+anio+"&mes="+mes+"&dia="+dia+"&hora_inicio="+hora_inicio+"&minuto_inicio="+minuto_inicio+"&hora_fin="+hora_fin+"&minuto_fin="+minuto_fin+"&id_grupo="+id_grupo;
          $.ajax({
              url:  destino,
              type: "post",
              dataType: "json",
              data: datos,
              async: true,
              success:function(respuesta)
              {
                  calEvent.id_estado_reserva = respuesta;
              }
          });
      },
      eventClick : function(calEvent, $event) {
         if (calEvent.readOnly) {
            return;
         }

         var $dialogContent = $("#event_edit_container");
         resetForm($dialogContent);
         var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
         var titleField = $dialogContent.find("input[name='title']");
         var bodyField = $dialogContent.find("input[name='body']");
         var id_grupoField = $dialogContent.find("select[name='id_grupo']").val(calEvent.id_grupo);
         var id_servicioField = $dialogContent.find("select[name='id_servicio']").val(calEvent.id_servicio);
         var id_estadoField = $dialogContent.find("select[name='id_estado_reserva']").val(calEvent.id_estado_reserva);
         var contactoField = $dialogContent.find("input[name='contacto']").val(calEvent.contacto);
//          alert(calEvent.id_estado_reserva);
         bodyField.val(calEvent.body);

         $dialogContent.dialog({
            modal: true,
            width: "750px",
            title: "Editar reserva",
            close: function() {
               $dialogContent.dialog("destroy");
               $dialogContent.hide();
               $('#calendar').weekCalendar("removeUnsavedEvents");
            },
            buttons: {
               Actualizar : function() {




                  /*calEvent.start = new Date(startField.val());
                  calEvent.end = new Date(endField.val());
                  calEvent.title = titleField.val();
                  calEvent.body = bodyField.val();
                  calEvent.nombre_grupo = $("#id_grupo :selected").text();
                  calEvent.id_grupo = id_grupoField.val();
                  calEvent.id_servicio = id_servicioField.val();
                  calEvent.id_estado_reserva = id_estadoField.val();
                  calEvent.contacto = contactoField.val();*/

                  var horario_inicio = new Date(startField.val());
                  var horario_fin = new Date(endField.val());
                  /*
                  var anio = calEvent.start.getFullYear();
                  var mes = calEvent.start.getMonth()+1;
                  var dia = calEvent.start.getDate();
                  var hora_inicio = calEvent.start.getHours();
                  var minuto_inicio = calEvent.start.getMinutes();
                  var hora_fin = calEvent.end.getHours();
                  var minuto_fin = calEvent.end.getMinutes();

                  var id_sala = $("#id_sala").val();
                  var title = titleField.val();
                  var body = bodyField.val();
                  var id_grupo = $("#id_grupo").val();
                  var id_servicio = $("#id_servicio").val();
                  {{--var destino = "{{ Route('calendario.actualizarEvento') }}";--}}
                  var datos = "id="+calEvent.id+"&id_sala="+id_sala+"&anio="+anio+"&mes="+mes+"&dia="+dia+"&hora_inicio="+hora_inicio+"&minuto_inicio="+minuto_inicio+"&hora_fin="+hora_fin+"&minuto_fin="+minuto_fin+"&comentario="+body+"&id_grupo="+id_grupo+"&id_servicio="+id_servicio;
                  $.ajax({
                      url:  destino,
                      type: "post",
                      dataType: "json",
                      data: datos,
                      async: false,
                      success:function(respuesta)
                      {
                          calEvent.id_estado_reserva = respuesta;
                      }
                  });
                   $calendar.weekCalendar("updateEvent", calEvent);
                   $dialogContent.dialog("close");*/

                   var anio = horario_inicio.getFullYear();
                   var mes = horario_inicio.getMonth()+1;
                   var dia = horario_inicio.getDate();
                   var hora_inicio = horario_inicio.getHours();
                   var minuto_inicio = horario_inicio.getMinutes();
                   var hora_fin = horario_fin.getHours();
                   var minuto_fin = horario_fin.getMinutes();
                   var fecha = dia+"/"+mes+"/"+anio;

                   var id_sala = $("#id_sala").val();
                   var title = titleField.val();
                   var body = bodyField.val();
                   var id_grupo = $("#id_grupo").val();
                   var id_servicio = $("#id_servicio").val();
                   var destino = "{{ Route('calendario.nuevoEvento') }}";
                   var datos = "id="+calEvent.id+"&id_sala="+id_sala+"&fecha="+fecha+"&hora_inicio="+hora_inicio+"&minuto_inicio="+minuto_inicio+"&hora_fin="+hora_fin+"&minuto_fin="+minuto_fin+"&title="+title+"&comentario="+body+"&id_grupo="+id_grupo+"&id_estado_reserva="+id_estado_reserva+"&id_servicio="+id_servicio;

                   var destino = "{{ Route('calendario.validarDatosCalendario') }}";
                   $.ajax({
                       type: "Post",
                       url: destino,
                       data: datos,
                       async: true,
                       success: function(respuesta){
                           if(respuesta)
                           {
                               darMensaje("popup_mensaje",300,500,respuesta);
                           }
                           else
                           {
                               calEvent.start = new Date(startField.val());
                               calEvent.end = new Date(endField.val());
                               calEvent.title = titleField.val();
                               calEvent.body = bodyField.val();
                               calEvent.nombre_grupo = $("#id_grupo :selected").text();
                               calEvent.id_grupo = id_grupoField.val();
                               calEvent.id_servicio = id_servicioField.val();
                               calEvent.id_estado_reserva = id_estadoField.val();
                               calEvent.contacto = contactoField.val();

                               var datos = "id="+calEvent.id+"&id_sala="+id_sala+"&anio="+anio+"&mes="+mes+"&dia="+dia+"&hora_inicio="+hora_inicio+"&minuto_inicio="+minuto_inicio+"&hora_fin="+hora_fin+"&minuto_fin="+minuto_fin+"&comentario="+body+"&id_grupo="+id_grupo+"&id_servicio="+id_servicio;
//                               var datos = "id="+calEvent.id+"&id_sala="+id_sala+"&fecha="+fecha+"&hora_inicio="+hora_inicio+"&minuto_inicio="+minuto_inicio+"&hora_fin="+hora_fin+"&minuto_fin="+minuto_fin+"&title="+title+"&comentario="+body+"&id_grupo="+id_grupo+"&id_estado_reserva="+id_estado_reserva+"&id_servicio="+id_servicio;
                               var destino = "{{ Route('calendario.actualizarEvento') }}";
//                               calEvent.id = respuesta;
                               $calendar.weekCalendar("removeUnsavedEvents");
                               $calendar.weekCalendar("updateEvent", calEvent);
                               $.ajax({
                                   url:  destino,
                                   type: "post",
                                   dataType: "json",
                                   data: datos,
                                   async: true,
                                   success:function(respuesta)
                                   {
                                       calEvent.id_estado_reserva = respuesta;
//                                       calEvent.id = respuesta;
                                       $calendar.weekCalendar("updateEvent", calEvent);
                                       $dialogContent.dialog("close");


                                   }
                               });
                               $dialogContent.dialog("close");
                           }
                       }

                   });

               },
               "Cancelar reserva" : function() {
                    var id = calEvent.id;
                    var destino = "{{ Route('calendario.eliminarEvento') }}";
                    var datos = "id="+calEvent.id;
                    $.ajax({
                        url:  destino,
                        type: "post",
                        dataType: "json",
                        data: datos,
                        async: true,
                        success:function(respuesta)
                        {
                        }
                    });

                  $calendar.weekCalendar("removeEvent", calEvent.id);
                  $dialogContent.dialog("close");
               },
               Cerrar : function() {
                  $dialogContent.dialog("close");
               }
            }
         }).show();

         /*var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);*/
         $dialogContent.find(".date_holder").text($calendar.weekCalendar("formatDate", calEvent.start));
         setupStartAndEndTimeFields(startField, endField, calEvent, $calendar.weekCalendar("getTimeslotTimes", calEvent.start));
         $(window).resize().resize(); //fixes a bug in modal overlay size ??

      },
      eventMouseover : function(calEvent, $event) {
      },
      eventMouseout : function(calEvent, $event) {
      },
      noEvents : function() {

      },
      data : function(start, end, callback) {
         callback(getEventData());
      }
   });

   function resetForm($dialogContent) {
      $dialogContent.find("input").val("");
      $("#id_grupo").val("");
      $("#id_estado_reserva").val("");
      $("#id_servicio").val("");
      $dialogContent.find("textarea").val("");
   }

    function ponerCeros(value) {
//        alert(value);
        while (value.length<2)
            value = '0'+value;
        return value;
    }

   function getEventData() {
       var id_sala = $("#id_sala").val();
       var destino = "{{ Route('calendario.darReservasXSala') }}";
       var datos = "id_sala="+id_sala;
       var res = $.ajax({
           url:  destino,
           type: "post",
           dataType: "json",
           data: datos,
           async: false,
           success:function(respuesta){
           }
       });
       var lista = [{}];
       var respuesta = JSON.parse(res.responseText);
//       setRespuesta(respuesta);
//       console.log(respuesta);

       //console.log(content);



       calendarioDispositivo(respuesta);



       var l = respuesta.length;
       for (var i=0; i<l; i++) {
           lista.push({
               "id": respuesta[i].id,
               "start": new Date(respuesta[i].anio, respuesta[i].mes-1, respuesta[i].dia, respuesta[i].hora_inicio, respuesta[i].minuto_inicio),
               "end": new Date(respuesta[i].anio, respuesta[i].mes-1, respuesta[i].dia, respuesta[i].hora_fin, respuesta[i].minuto_fin),
               "title": respuesta[i].title,
               "body": respuesta[i].comentario,
               "id_grupo": respuesta[i].id_grupo,
               "id_estado_reserva": respuesta[i].id_estado_reserva,
               "id_servicio": respuesta[i].id_servicio,
               "readOnly": respuesta[i].readOnly,
               "nombre_grupo": respuesta[i].nombre,
               "contacto": respuesta[i].contacto
           })
       }
       var registro = {
           events: lista
       }
       registro.events.splice(0,1);
       return registro;
   }

    function setRespuesta(respuesta)
    {
        respuesta = respuesta;
    }

    function getRespuesta()
    {
        return respuesta;
    }

    function calendarioDispositivo(respuesta)
    {
//        console.log(respuesta);
        $("#calendario_celular").empty();
        var f = new Date(parseFloat($("#hidden_fecha").val()));
//       $("#fecha").val(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());

        var anio = f.getFullYear();
        var mes = f.getMonth() + 1;
        var dia = f.getDate();

        for(var hora = 0; hora <= 23; hora++ )
        {
            var ban = true;
            for(var minutos = 0; minutos < 60; minutos = minutos + 30)
            {

                var grupo = "Disponible";
                for(var f=0;f<respuesta.length;f++)
                {
                    if(respuesta[f].anio == anio && respuesta[f].mes == mes && respuesta[f].dia == dia)
                    {
                        if(respuesta[f].hora_inicio == hora && respuesta[f].minuto_inicio == minutos)
                        {
                            grupo = respuesta[f].nombre;

                        }
                        else if(respuesta[f].hora_inicio <= hora && respuesta[f].hora_fin > hora)
                        {
                            if(respuesta[f].minuto_inicio <= minutos)
                            {
                                grupo = respuesta[f].nombre;
                            }
                            else if(respuesta[f].hora_inicio < hora && respuesta[f].hora_fin > hora)
                            {
                                grupo = respuesta[f].nombre;
                            }
                        }
                        else if(respuesta[f].hora_inicio >= hora && respuesta[f].hora_fin == hora)
                        {
                            if(respuesta[f].minuto_fin >= minutos)
                            {
                                grupo = respuesta[f].nombre;

                            }
                        }

                    }

                }
                var imagen = '{{ HTML::image("images/agregar.png", "Imagen no encontrada",["id" => "agregar","style" => "height: 32px; width: 32px"]) }}';
                var agregar = "<label style='position: absolute;right: 0; margin-right: 5px'><a style='margin-left: 10px' title='Agregar' href='{{ route('calendario.nuevoEventoResponsive') }}'>"+imagen+"</a></label>";

                if(grupo === "Disponible")
                    $("#calendario_celular").append("<div class='hora'>"+ponerCeros(hora.toString())+":"+ponerCeros(minutos.toString())+" hs <label class='evento'>"+grupo+"</label>"+agregar);
                else
                    $("#calendario_celular").append("<div class='hora_ocupada'>"+ponerCeros(hora.toString())+":"+ponerCeros(minutos.toString())+" hs <label class='evento'>"+grupo+"</label>");

//                $("#calendario_celular").append("<label>"+grupo+"</label></div>");
            }
        }
    }


   /*
    * Sets up the start and end time fields in the calendar event
    * form for editing based on the calendar event being edited
    */
   function setupStartAndEndTimeFields($startTimeField, $endTimeField, calEvent, timeslotTimes) {

      for (var i = 0; i < timeslotTimes.length; i++) {
         var startTime = timeslotTimes[i].start;
         var endTime = timeslotTimes[i].end;
         var startSelected = "";
         if (startTime.getTime() === calEvent.start.getTime()) {
            startSelected = "selected=\"selected\"";
         }
         var endSelected = "";
         if (endTime.getTime() === calEvent.end.getTime()) {
            endSelected = "selected=\"selected\"";
         }
         $startTimeField.append("<option value=\"" + startTime + "\" " + startSelected + ">" + timeslotTimes[i].startFormatted + "</option>");
         $endTimeField.append("<option value=\"" + endTime + "\" " + endSelected + ">" + timeslotTimes[i].endFormatted + "</option>");

      }
      $endTimeOptions = $endTimeField.find("option");
      $startTimeField.trigger("change");
   }

   var $endTimeField = $("select[name='end']");
   var $endTimeOptions = $endTimeField.find("option");

   //reduces the end time options to be only after the start time options.
   $("select[name='start']").change(function() {
      var startTime = $(this).find(":selected").val();
      var currentEndTime = $endTimeField.find("option:selected").val();
      $endTimeField.html(
            $endTimeOptions.filter(function() {
               return startTime < $(this).val();
            })
            );

      var endTimeSelected = false;
      $endTimeField.find("option").each(function() {
         if ($(this).val() === currentEndTime) {
            $(this).attr("selected", "selected");
            endTimeSelected = true;
            return false;
         }
      });

      if (!endTimeSelected) {
         //automatically select an end date 2 slots away.
         $endTimeField.find("option:eq(1)").attr("selected", "selected");
      }

   });


   var $about = $("#about");

   $("#about_button").click(function() {
      $about.dialog({
         title: "About this calendar demo",
         width: 600,
         close: function() {
            $about.dialog("destroy");
            $about.hide();
         },
         buttons: {
            close : function() {
               $about.dialog("close");
            }
         }
      }).show();
   });


});
</script>