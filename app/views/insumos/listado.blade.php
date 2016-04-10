@extends ('master')
@section ('script')

<script>
    $().ready(function()
    {
        $('#myTableProductos').dataTable({
            "sDom":'T<"clear">lfrtip',
            "aaSorting": [ ],
            "language":{
                "url":'{{ URL::asset("assets/js/dataTables.lang.es.json") }}'
            }});

        $('#myTableServicios').dataTable({
            "sDom":'T<"clear">lfrtip',
            "aaSorting": [ ],
            "language":{
                "url":'{{ URL::asset("assets/js/dataTables.lang.es.json") }}'
            }});

        $('#myTableVentas').dataTable({
            "sDom":'T<"clear">lfrtip',
            "aaSorting": [ ],
            "language":{
                "url":'{{ URL::asset("assets/js/dataTables.lang.es.json") }}'
            }});
        $("#li_ventas").click(function(){
            desbloquear();
        });
        $("#li_productos").click(function(){
            desbloquear();
        });
        $("#li_servicios").click(function(){
            desbloquear();
        });
    });
</script>
@stop
@section ('title') Listado de insumos - Shelter @stop
@section ('content')

<h1>Insumos</h1>

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#sectionA" id="li_ventas">Ventas</a></li>
    <li><a data-toggle="tab" href="#sectionB" id="li_productos">Productos</a></li>
    <li><a data-toggle="tab" href="#sectionC" id="li_servicios">Servicios</a></li>
</ul>
<div class="tab-content">
    @include("insumos.ventas")

    @include("insumos.productos")

    @include("insumos.servicios")
</div>



@stop