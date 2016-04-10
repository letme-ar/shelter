<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel PHP Framework</title>
    {{ HTML::style('assets/css/bootstrap.min.css', array('media' => 'screen')) }}
</head>
<body>
<div class="container">
    <h1>Bienvenido {{ Auth::user()->username; }}</h1>
    <a href="/logout">Cerrar sesión.</a>
</div>
<script src="https://code.jquery.com/jquery.js"></script>
{{ HTML::script('js/bootstrap.js'); }}
</body>
</html>
