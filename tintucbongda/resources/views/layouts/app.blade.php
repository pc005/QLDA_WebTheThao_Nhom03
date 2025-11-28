<!DOCTYPE html>
<html lang="en">

<head>
    <title>Blog Detail With Sidebar</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('css/util.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>
    @include('partials._header')

    @yield('content')

    @include('partials._footer')
</body>
<script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('libs/toastr/toastr.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('libs/toastr/toastr.min.css') }}">


