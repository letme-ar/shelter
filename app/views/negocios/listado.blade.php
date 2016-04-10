@extends ('master')
@section ('script')

@include('negocios.scripts')

@stop
@section ('title') Listado de negocios - Shelter @stop
@section ('content')
<div class="row" style="margin-bottom:20px;">
    <div class="col-md-6"><h2>Listados de negocios</h2>
    </div>
    <div class="col-md-6" style="text-align:right; padding-top:30px;"><a href="{{ route('negocio.create') }}" class="btn btn-primary">Agregar</a>
    </div>
</div>
<table id="myTable" class="table">
    <thead>
    <tr>
        <th>Nombre</th>
        <th class="celular ">Teléfono principal</th>
        <th class="celular ">Localidad</th>
        <th class="celular tablet">Dirección</th>
        <th class="celular tablet">Facebook</th>
        <th class="celular ">Estado</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($negocios as $key => $value)
        <tr>
                <td>{{{ $value->nombre }}}</td>
                <td class="celular">{{ $value->telefono }}</td>
                <td class="celular">{{ $value->id_localidad }}</td>
                <td class="celular tablet">{{{ $value->direccion }}}</td>
                <td class="celular tablet">{{{ $value->facebook }}}</td>
                <td class="celular">{{ $value->estado }}</td>
            <td>
            <a href="{{ route('negocio.edit', $value->id) }}" class="btn btn-success btn-sm">
                Editar
            </a>
            <input type="button" value="Cambiar estado" id="{{ $value->id }}-{{ $value->estado }}" class="btn btn-danger btn-sm btnEliminar" />
        </td>

    </tr>
    @endforeach
    </tbody>
</table>
<div id="pregunta" style="display:none">¿Confirma que desea desactivar el negocio?</div>

@stop