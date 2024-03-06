<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/presupuesto.png" type="image/x-icon">

    <title>{{ config('app.name', 'Laravel') }} | Iniciar Sesión</title>

    @include('partials.styles')

</head>

<body style="font-family: 'Hero' !important">
    <div style="justify-content: center; align-items: center; display: flex; height: 100vh;">
        <h1 class="text-center">Tu sesión ha caducado, abrir nuevamente desde
            <a id="litoapps_href" href="">LitoApps</a>
        </h1>
    </div>

    <script>
        var URLactual = window.location;
        if (URLactual.hostname == '127.0.0.1') {
            var base_path = "{{ URL::asset('/') }}";
        } else {
            var base_path = URLactual.origin + '/litoapps/';
        }
        lito = document.getElementById('litoapps_href');
        lito.href = base_path;
    </script>
</body>

</html>
