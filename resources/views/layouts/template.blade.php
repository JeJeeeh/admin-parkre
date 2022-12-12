<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parkre</title>
    @vite(['resources/css/app.css'])
    @stack('chart_script')
    <link rel="preload" href="https://placeimg.com/80/80/people" as="image">
</head>

<body>
    <header>
        @yield('header')
    </header>

    <main>
        @yield('main')
    </main>

    <footer>
        @include('layouts.footer')
    </footer>

    @vite('resources/js/app.js')
</body>

</html>
