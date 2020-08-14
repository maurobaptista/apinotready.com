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
    <div class="bg-gradient relative w-full top-0 h-40 md:h-96">
        <h1 class="max-w-6xl mx-auto text-center pt-10 text-white text-4xl font-title font-extrabold">
            {{ config('app.name') }}
        </h1>

        <div class="divider divider-bottom divider-rotated">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="fill-current text-white h-32">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
            </svg>
        </div>
    </div>

    <div class="w-full m-auto max-w-xs md:max-w-2xl flex -mt-64">
        <div class="w-full bg-white p-4 rounded-lg shadow-xl z-10" style="top: -16rem">
            @yield('content')
        </div>
    </div>

    <div class="bg-white mt-10">
        <div class="w-full m-auto max-w-xs md:max-w-2xl p-10">
            <h2 class="text-gradient text-4xl font-title font-bold md:absolute">
                Email? Why?
            </h2>
            <article class="mt-4 text-lg mt-16">
                <p class="mb-6">Adding your email you will have predictable endpoints, as the subdomain will be based on the domain.</p>
                <p class="mb-2 font-bold">Sample without email:</p>
                <p class="mb-6">http://api.apinotready.com/<span class="marked bg-gradient text-white font-bold">37YL4QMWQE</span>/sample/endpoint</p>
                <p class="mb-2 font-bold">Sample with email:</p>
                <p class="mb-2">http://<span class="marked bg-gradient text-white font-bold">45EG523LPK</span>.apinotready.com/sample/endpoint</p>
            </article>
        </div>
    </div>

    <div class="bg-purple-gradient relative">
        <div class="divider divider-top">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"
                 class="fill-current text-white h-10"
            >
                <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z"></path>
            </svg>
        </div>

        <div class="w-full m-auto max-w-xs md:max-w-2xl md:relative p-10 mt-5">
            <h2 class="w-full text-gradient text-4xl font-title font-bold md:absolute"
                style="top: -10px"
            >
                Open Source
            </h2>
            <article class="my-4 text-lg">
                <p class="mb-6">All the code to make this tool is available at <a href="https://github.com/maurobaptista/apinotready.com" class="hover:font-bold">Github</a></p>
                <p class="mb-6">Created using TALL stack:</p>
                <div class="grid grid-cols-2 gap-4 text-4xl font-title font-bold text-center text-black">
                    <div>Tailwind CSS</div>
                    <div>Alpine.js</div>
                    <div>Laravel</div>
                    <div>Livewire</div>
                </div>
            </article>
        </div>

        <div class="divider divider-bottom divider-rotated w-full">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"
                 class="fill-current text-white h-10"
            >
                <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z"></path>
            </svg>
        </div>
    </div>

    <div class="bg-white">
        <div class="w-full m-auto max-w-xs md:max-w-2xl p-10">
            <h2 class="text-gradient text-4xl font-title font-bold md:absolute">
                Roadmap
            </h2>
            <article class="mt-4 text-lg mt-16">
                <p class="mb-6">Ideas for a near future:</p>
                <ul class="list-disc list-inside pl-4">
                    <li>Improve layout</li>
                    <li>No password login</li>
                    <li>Endpoint management</li>
                    <li>Easy switch responses per endpoint</li>
                </ul>
            </article>
        </div>
    </div>

    <div class="bg-gradient relative w-full top-0 h-40 md:h-64">
        <div class="divider divider-top">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="fill-current text-white h-32">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
            </svg>
        </div>

        <h1 class="max-w-6xl mx-auto text-center pt-40 text-white">
            <p>Made by Mauro Baptista</p>
            <div class="flex flex-row justify-center">
                <a href="https://www.twitter.com/carnou" class="m-4 hover:font-bold">Twitter</a>
                <a href="https://www.github.com/maurobaptita" class="m-4 hover:font-bold">Github</a>
                <a href="https://www.carnou.com" class="m-4 hover:font-bold">Blog</a>
                <a href="https://www.linkedin.com/in/maurobaptista/" class="m-4 hover:font-bold">Linkedin</a>
            </div>
        </h1>
    </div>

    <div style="width: 64px; height: 64px;" class="bg-gradient font-title text-white font-bold rounded-lg m-64 relative">
        <div class="absolute text-6xl">A</div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    @livewireScripts
    @stack ('scripts')
</body>
</html>
