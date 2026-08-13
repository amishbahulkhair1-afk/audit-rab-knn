<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <!-- TAMBAHKAN PEMBUNGKUS VUE DI SINI -->
    <div id="app">

        <div class="min-h-screen">

            @auth

                @include('layouts.sidebar')

            @endauth

            <div :class="sidebarMini ? 'lg:ml-20' : 'lg:ml-72'" class="flex-1 bg-gray-100 transition-all duration-300">

                @isset($header)
                    <header class="bg-white shadow">
                        <div class="px-6 py-4 flex items-center gap-4">
                            <button @click="toggleSidebar" class="lg:hidden text-xl p-2 rounded-lg hover:bg-slate-100">

                                ☰

                            </button>
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main class="p-6">
                    {{ $slot }}
                </main>

            </div>

        </div>

    </div> <!-- PENUTUP PEMBUNGKUS VUE -->

</body>

@stack('scripts')

</html>
