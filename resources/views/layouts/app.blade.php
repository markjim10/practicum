<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IT199R-2</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <script src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> --}}

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet"> --}}

    <!-- Styles -->

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/sidebar.css') }}" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>

    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/en/2/21/Malayan_Colleges_Laguna%27s_new_logo.svg">

</head>
<body>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
    @include('layouts.footer')
</body>
</html>
