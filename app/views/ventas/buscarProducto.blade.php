{{ Form::label('producto', '' ) }}
{{ Form::text('producto', "", array('placeholder' => 'Ingrese el producto','id' => 'producto')) }}
{{ Form::button('Buscar',array('type' => 'button', 'class' => 'btn btn-success btn-sm', 'id' => 'btnBuscar')) }}
