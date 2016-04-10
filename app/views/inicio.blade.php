@extends ('master')
@section ('script')
@stop
@section ('content')
<div class="page-header">
    <h1>Bienvenido {{ Auth::user()->username; }}</h1>
</div>
@stop