<div id="sectionC" class="tab-pane fade in responsive">
    <div class="row" style="margin-bottom:20px;">
        <div class="col-md-6">
            <h3>Listado de servicios</h3>
        </div>
        <div class="col-md-6" style="text-align:right; padding-top:30px;"><a href="{{ route('servicio.create') }}" class="btn btn-primary">Agregar servicio</a>
        </div>
    </div>
    <table id="myTableServicios" class="table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th class="celular">Inicio de vigencia</th>
            <th>Fin de vigencia</th>
            <th>Precio de venta</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($servicios as $key => $value)
        <tr>
            <td>{{ $value->nombre }}</td>
            <td class="celular">{{ $value->vigencia_desde_title }}</td>
            <td>{{ $value->vigencia_hasta_title }}</td>
            <td>${{ $value->precio_venta }}</td>
            <td>
                <a href="{{ route('servicio.edit', $value->id) }}" class="btn btn-success btn-sm">
                Editar
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>