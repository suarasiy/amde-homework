<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Amde | Main app')</title>

    {{-- additional custom fonts --}}
    @stack('custom-fonts')
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- base css --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- additional custom css --}}
    @stack('custom-css')

    {{-- additional custom inline-styles --}}
    @stack('custom-styles')
</head>

<body class="antialiased">
    {{-- body slicing --}}
    @yield('body')
</body>

</html>
