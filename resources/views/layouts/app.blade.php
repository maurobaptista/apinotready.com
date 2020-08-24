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
<body class="bg-white font-sans text-gray-700"
      x-data="{ 'showModal': true }" @keydown.escape="showModal = false" x-cloak
>
    @include ('layouts.common.header')

    <div class="w-full m-auto max-w-xs md:max-w-2xl flex -mt-64">
        <div class="w-full bg-white p-4 rounded-lg shadow-xl z-0" style="top: -16rem">
            @yield('content')
        </div>
    </div>

    @include ('layouts.blocks.email')
    @include ('layouts.blocks.opensource')
    @include ('layouts.blocks.roadmap')

    @include ('layouts.common.footer')


    <script src="{{ mix('js/app.js') }}"></script>
    @livewireScripts
    @stack ('scripts')
</body>
</html>
