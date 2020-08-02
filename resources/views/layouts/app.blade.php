<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @section('header')
        <title>{{ config('app.name') }}</title>
    @show

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body class="flex bg-gray-200">
    <div class="w-full max-w-xs m-auto">

        @yield('content')
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    @stack ('script')
    @livewireScripts
</body>
</html>
