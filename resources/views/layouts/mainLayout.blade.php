<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>{{$title ?? "MRX"}}</title>
</head>
<body class="backgroundImage">
    <header class="flex flex-row w-full bg-main content-between justify-between">
        <div class="bg-gold w-1/12"></div>
        @livewire('nav-menu')
        <div class="bg-gold w-1/12"></div>
    </header>
    <main class="flex justify-center">
            @yield('main')
    </main>


</body>
</html>
