<div id="sectionA" class="tab-pane fade in active responsive">

    <div class="row" style="margin-bottom:20px;">
        <div class="col-md-6">
            <h3>Listado de ventas</h3>
        </div>
        <div class="col-md-6" style="text-align:right; padding-top:30px;"><a id="agregarVenta" name="agregarVenta" href="{{ route('venta.create') }}" class="btn btn-primary">Registrar venta</a>
        </div>
    </div>

    <table id="myTableVentas" class="table">
        <thead>
        <tr>
            <th>Grupo</th>
            <th>Fecha</th>
            <th>Monto total</th>
            <th>Acciones</th>
        </tr>
        </thead>
        @foreach($ventas as $key => $value)
        <tr>
            <td>{{ $value->grupo->nombre }}</td>
            <td>{{ $value->created_at_title }}</td>
            <td>${{ $value->precio_unitario }}</td>
            <td>
                <a id="btnDetalle" name="btnDetalle" href="{{ route('venta.verDetalle', $value->id ) }}" class="btn btn-success btn-sm">
                    Detalle
                </a>
            </td>
        </tr>
        @endforeach    </table>
</div>