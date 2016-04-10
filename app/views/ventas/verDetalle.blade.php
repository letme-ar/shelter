@extends ('master')
@section('script')

<script>

    $().ready(function()
    {
        $(".btnAnular").click(function(){
            $("#pregunta").modal(function(){show:true})
            $("#id_seleccionado").val(this.id);
        });

        $("#eliminar").click(function(){
            var id = $("#id_seleccionado").val();
            $.ajax({
                type: "POST",
                data: "id="+id,
                url : '{{ route("venta.anular")}}',
                success: function(respuesta)
                {
                    $("#pregunta").modal("hide");
                    if(respuesta == "Ok")
                    {
                        $("#contenido-modal").html("Se ha anulado la venta");
                        $("#confirmacion").modal(function(){show:true});
                        $(location).attr('href',"{{ route('insumo.index') }}");
                    }
                }
            });
        });
    });

</script>
@stop
@section ('content')
<h1> Detalle de la venta</h1>

<div class="page-header">
    {{ Form::hidden('id_seleccionado',null,['id' => 'id_seleccionado']) }}

    <div class="col-md-12" style="padding: 0px">
        {{ Field::select('id_grupo','Grupo', $combo_grupos,$venta[0]->id_grupo,['disabled' => 'true'] ) }}
        {{ Field::text('fecha','Fecha de compra',$venta[0]->created_at_title,['disabled' => 'true'])}}
    </div>

    <div id="ventas">{{ $lista_productos }}</div>
    <div class="row">
        <div class="form-group col-md-12" style="margin-top: 20px">
            {{ Form::button('Anular',array('type' => 'button', 'class' => 'btn btn-danger btnAnular', 'id' => $venta[0]->id)) }}
            <a href="{{ route('insumo.index') }}" class="btn btn-success">Volver</a>
        </div>
        <div id="divMensaje"></div>
    </div>

    @include("fields.modal")

</div>

    @stop