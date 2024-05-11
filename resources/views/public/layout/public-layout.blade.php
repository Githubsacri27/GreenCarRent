<!DOCTYPE html>
<html lang="es">
<head>
    <title>
        @yield("title")
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @stack('javascript')
</head>
<body class="d-flex flex-column min-vh-100">
@include("public.navbar.main-navbar")
@yield('content')
@include("components.footer")
</body>
</html>
