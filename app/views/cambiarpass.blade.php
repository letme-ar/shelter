@extends('master')
@section('title') Cambiar contraseña
@stop
@section('content')
<div class="page-header">
    {{ Form::open(array('url'=>'auth/cambiarPassword', 'class'=>'block small center login','method' => 'post')) }}
    <h2 class="">Cambiar contraseña</h2>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        <div class="row">
            <div class="form-group col-md-4 col-md-offset-4">
                {{ Form::label('new_password', 'Contraseña nueva') }}
                {{ Form::password('new_password', array('class'=>'form-control', 'placeholder'=>'Nueva contraseña')) }}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4 col-md-offset-4">
                {{ Form::label('new_password_confirmation', 'Confirmar contraseña nueva') }}
                {{ Form::password('new_password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirma nueva contraseña')) }}
            </div>
        </div>

        @include("fields.botones_submit")

    {{ Form::close() }}
</div>
@stop