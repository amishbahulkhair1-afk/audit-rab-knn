<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistem Audit Bangunan & RAB</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 font-sans antialiased">

    <div id="app">

        <div class="min-h-screen flex flex-col">

            <!-- Header -->
            <header class="bg-blue-700 shadow">
                <div class="max-w-7xl mx-auto px-6 py-5">

                    <h1 class="text-3xl font-bold text-white">
                        Sistem Audit Bangunan & RAB
                    </h1>

                    <p class="text-blue-100 mt-1">
                        Sistem Audit Kelayakan Bangunan dan Estimasi Anggaran Berbasis AHSP & K-Nearest Neighbor
                    </p>

                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 flex items-center justify-center px-4 py-10">

                <div class="w-full max-w-md">

                    <div class="bg-white rounded-2xl shadow-xl border">

                        <!-- Judul -->
                        <div class="bg-slate-50 rounded-t-2xl border-b p-6 text-center">

                            <div class="flex justify-center mb-4">

                                <a href="/">
                                    <x-application-logo class="w-16 h-16 text-blue-700" />
                                </a>

                            </div>

                            <h2 class="text-2xl font-bold text-slate-800">
                                Selamat Datang
                            </h2>

                            <p class="text-sm text-slate-500 mt-2">
                                Silakan login untuk melanjutkan ke sistem.
                            </p>

                        </div>

                        <!-- Form -->
                        <div class="p-8">

                            {{ $slot }}

                        </div>

                    </div>

                </div>

            </main>

            <!-- Footer -->
            <footer class="text-center text-sm text-gray-500 py-6">

                © {{ date('Y') }}
                Sistem Audit Bangunan & RAB

            </footer>

        </div>

    </div>

</body>

</html>
