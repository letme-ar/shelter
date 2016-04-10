<div class="row">
    <div class="form-group col-md-4 col-md-offset-4" style="margin-top: 20px;">
        <div class="col-md-12" style="display: block; text-align: center" >
            {{ Form::button($action,array('type' => 'submit', 'class' => 'btn btn-success', 'id' => 'btnAceptar')) }}
            <a href="{{ $ruta_index }}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
</div>