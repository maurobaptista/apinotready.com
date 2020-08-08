<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @section('header')
        <title>{{ config('app.name') }}</title>
    @show

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900"
        rel="stylesheet">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @livewireStyles
</head>
<body class="bg-white">
    <div class="hero-gradient relative h-40 md:h-64">
        <div class="max-w-6xl mx-auto text-center pt-10 text-white text-4xl font-title font-extrabold">
            {{ config('app.name') }}
        </div>

        <div class="hero-divider">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
    </div>

    <div class="w-full m-auto max-w-xs md:max-w-2xl md:relative">
        <div class="md:absolute w-full bg-white p-4 rounded-lg shadow-2xl"
            style="top: -150px"
        >
            @yield('content')
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    @stack ('script')
    @livewireScripts
</body>
</html>
