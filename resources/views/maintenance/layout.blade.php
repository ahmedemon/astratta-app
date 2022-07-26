<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maintenance Dashboard</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @stack('css')
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container justify-content-center">
            <span class="navbar-brand mb-0 h1 text-center">Maintenance Dashboard</span>
        </div>
    </nav>
    <div class="container-fluid my-4">
        @yield('content')
    </div>

    @stack('js')
</body>

</html>
