<?php
if (!isset($_GET['usuario'])) {
    $_SESSION['Usuario'] = '';
} else {
    $_SESSION['Usuario'] = $_GET['usuario'];
}
?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="img/presupuesto.png" type="image/x-icon">
   <title>{{ config('app.name', 'Laravel') }} | {{ request()->route()->getName() }}</title>

   @include('partials.styles')

</head>

<body id="bodyMantenimiento" class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
    <div id="landscape" style="display: none; height: 100vh !important; width: 100vw !important">
        <h1 style="text-align: center; margin-top: 15%">EL MODO HORIZONTAL NO ES SOPORTADO</h1>
    </div>
    <div id="landscape_hidden" class="wrapper">
        @include('partials.sidebar')
        <div id="home-section" class="home-section">
            @yield('content')
        </div>
    </div>

    @include('partials.scripts')
    @yield('scripts')

    <script>
        // disable right click
        // document.addEventListener('contextmenu', event => event.preventDefault());

        document.onkeydown = function(e) {

            // disable F12 key
            if (e.keyCode == 123) {
                return true;
                // return false;
            }

            // disable I key
            if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                return false;
            }

            // disable J key
            if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                return false;
            }

            // disable U key
            if (e.ctrlKey && e.keyCode == 85) {
                return false;
            }
        }
    </script>


</body>

</html>
