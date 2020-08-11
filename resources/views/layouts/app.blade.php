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
        href="https://fonts.googleapis.com/css?family=Nunito:400,700"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Fira+Code:400"
        rel="stylesheet">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @livewireStyles
</head>
<body class="bg-white font-sans text-gray-700">
    <div class="hero-gradient relative h-40 md:h-96">
        <div class="max-w-6xl mx-auto text-center pt-10 text-white text-4xl font-title font-extrabold">
            {{ config('app.name') }}
        </div>

        <div class="hero-divider">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" class="shape-fill"></path>
            </svg>
        </div>
    </div>

    <div class="w-full m-auto max-w-xs md:max-w-2xl md:relative">
        <div class="md:absolute w-full bg-white p-4 rounded-lg shadow-2xl"
            style="top: -16rem"
        >
            @yield('content')
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    @livewireScripts
    @stack ('scripts')
</body>
</html>
