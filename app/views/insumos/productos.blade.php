<div id="sectionB" class="tab-pane fade in responsive">

    <div class="row" style="margin-bottom:20px;">
        <div class="col-md-6">
            <h3>Listado de productos</h3>
        </div>
        <div class="col-md-6" style="text-align:right; padding-top:30px;"><a id="agregarProducto" name="agregarProducto" href="{{ route('producto.create') }}" class="btn btn-primary">Agregar producto</a>
        </div>
    </div>

    <table id="myTableProductos" class="table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Stock total</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productos as $key => $value)
        <tr>
            <td>{{ $value->nombre }}</td>
            <td>{{ $value->stock_total }}</td>
            <td>
                <a id="editarProducto" name="editarProducto" href="{{ route('producto.edit', $value->id ) }}" class="btn btn-success btn-sm">
                    Editar producto
                </a>
                <a id="agregarStock" name="agregarStock" href="{{ route('producto.agregarStock', $value->id ) }}" class="btn btn-primary btn-sm">
                    Agregar/Quitar stock
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
