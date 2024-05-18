<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="icon" href="{{ asset('assets/images/title.png') }}" type="image/png">
    <title>@yield('title')</title>
</head>

<body class="bg-body-tertiary">
    @yield('content')
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/fontawesome/js/all.min.js') }}"></script>
</body>

</html>
