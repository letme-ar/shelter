@extends ('master')
@section ('script')

@include('usuarios.scripts')

@stop
@section ('title') Listado de usuarios - Shelter @stop
@section ('content')
<div class="row" style="margin-bottom:20px;">
    <div class="col-md-6"><h2>Listados de usuarios</h2>
    </div>
    <div class="col-md-6" style="text-align:right; padding-top:30px;"><a href="{{ route('usuario.create') }}" class="btn btn-primary">Agregar</a>
    </div>
</div>
<table id="myTable" class="table">
    <thead>
    <tr>
        <th class="celular">Nombre</th>
        <th class="celular">Apellido</th>
        <th class="celular tablet">Tipo de usuario</th>
        <th>Usuario</th>
        <th >Estado</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($usuarios as $key => $value)
        <tr>
                <td class="celular">{{{ $value->nombre }}}</td>
                <td class="celular">{{{ $value->apellido }}}</td>
                <td class="celular tablet">{{ $value->tipo_usuario }}</td>
                <td>{{{ $value->username }}}</td>
                <td>{{ $value->estado_title }}</td>
            <td>
            <a href="{{ route('usuario.edit', $value->id) }}" class="btn btn-success btn-sm">
                Editar
            </a>
                <input type="button" value="Cambiar estado" id="{{ $value->id }}-{{ $value->estado_title }}" class="btn btn-danger btn-sm btnCambiarEstado" />
                <input type="button" value="Reiniciar password" id="{{ $value->id }}" class="btn btn-default btn-sm btnReiniciarPassword" />
        </td>

    </tr>
    @endforeach
    </tbody>
</table>
<div id="pregunta" style="display:none"></div>

@stop