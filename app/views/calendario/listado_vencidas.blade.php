<div class="row" style="margin-bottom:20px;">
    <div><h2>Listado de reservas vencidas</h2>
    </div>
</div>
<table id="myTable" class="table">
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Horario</th>
        <th>Grupo</th>
        <th>Comentario</th>
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    {{ Form::open(array('route' => 'calendario.actualizarGanadasPerdidas','id' => 'form')) }}
    @foreach($listado_vencidas as $key => $value)
        <tr>
            <td>{{ $value->dia }}/{{ $value->mes }}/{{ $value->anio }}</td>
            <td>{{ $value->horario_inicio }} a {{ $value->horario_fin }}</td>
            <td>{{ $value->nombre_grupo }}</td>
            <td>{{ $value->comentario }}</td>
            <td>{{ Form::select('id_estado'.$value->id, $combo_estado,null, array('id' => 'id_estado'.$value->id,'class' => 'id_estilo')) }}</td>
        </tr>
    @endforeach
    {{ Form::close() }}

    </tbody>
</table>