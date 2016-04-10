<h3>Histórico de stock del producto</h3>

<table id="myTable" class="table">
    <thead>
    <tr>
        <th>Agregado el dia</th>
        <th>Proveedor</th>
        <th>Precio de costo</th>
        <th>Precio de venta</th>
        <th>Comentario</th>
        <th>Stock</th>
    </tr>
    </thead>
    <tbody>
    @foreach($productoxstock as $key => $value)
    <tr>
        <td>{{ $value->created_at_title }}</td>
        <td>{{ $value->proveedor }}</td>
        <td>{{ $value->precio_costo }}</td>
        <td>{{ $value->precio_venta }}</td>
        <td>{{ $value->comentario }}</td>
        <td>{{ $value->stock_inicial }}</td>
    </tr>
    @endforeach
    @if($cantidad_vendida)
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>Cantidad vendida:</th>
        <th>-{{ $cantidad_vendida }}</th>
    </tr>
    @endif
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>Total:</th>
        <th>{{ $stock_total }}</th>
    </tr>
    </tbody>
</table>