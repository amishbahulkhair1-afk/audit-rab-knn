<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WorkInfra') }}</title>

    {{-- =====================================================
         FONT
    ====================================================== --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- =====================================================
         VITE
    ====================================================== --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body x-data="{
    zoom: parseInt(localStorage.getItem('app_zoom') || 90)
}" x-init="document.documentElement.style.fontSize = zoom + '%';

$watch('zoom', value => {
    document.documentElement.style.fontSize = value + '%';
    localStorage.setItem('app_zoom', value);
});"
    class="
        font-sans
        antialiased
        text-slate-900
        overflow-hidden
        bg-[#eaf3ff] dark:bg-slate-950 transition-colors duration-300
    ">

    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}
    @auth
        @include('layouts.sidebar')
    @endauth

    @php
        $headerNotifications = \App\Models\Audit::with('building')->latest()->limit(5)->get();
    @endphp


    {{-- =====================================================
         MAIN AREA

         Sidebar = 18rem / 288px
    ====================================================== --}}
    <div
        class="
            h-screen

            sm:ml-72

            overflow-hidden

            bg-[#eef5ff] dark:bg-slate-900 transition-colors duration-300
        ">

        {{-- =================================================
             MAIN WORKSPACE

             IMPORTANT:
             Background sama persis dengan sidebar.
        ================================================== --}}
        <div
            class="
                h-full

                overflow-hidden

                flex
                flex-col

                bg-[#eef5ff]

                rounded-tr-[32px]
                rounded-br-[32px]
            ">

            {{-- =================================================
                 HEADER
            ================================================== --}}
            @isset($header)
                <header
                    class="
                        shrink-0

                        mx-3
                        mt-3

                        px-5
                        py-4

                        flex
                        items-center
                        justify-between

                        gap-4

                        relative
                        z-30

                        bg-white/75

                        backdrop-blur-xl

                        border
                        border-white/80

                        rounded-[24px]

                        shadow-2xl
                    ">

                    {{-- =========================================
                         LEFT SIDE
                    ========================================== --}}
                    <div
                        class="
                            flex
                            items-center
                            gap-3

                            min-w-0
                        ">

                        {{-- =====================================
                             MOBILE SIDEBAR BUTTON
                        ====================================== --}}
                        <button data-drawer-target="app-sidebar" data-drawer-toggle="app-sidebar" type="button"
                            class="
                                inline-flex
                                items-center
                                justify-center

                                p-2

                                text-slate-500

                                rounded-xl

                                sm:hidden

                                hover:bg-slate-100
                                hover:text-slate-800

                                transition
                            ">

                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">

                                <path clip-rule="evenodd" fill-rule="evenodd" d="
                                                                                        M2 4.75
                                                                                        A.75.75 0 012.75 4h14.5
                                                                                        a.75.75 0 010 1.5H2.75
                                                                                        A.75.75 0 012 4.75z

                                                                                        M2 9.75
                                                                                        A.75.75 0 012.75 9h14.5
                                                                                        a.75.75 0 010 1.5H2.75
                                                                                        A.75.75 0 012 9.75z

                                                                                        M2 14.75
                                                                                        A.75.75 0 012.75 14h14.5
                                                                                        a.75.75 0 010 1.5H2.75
                                                                                        A.75.75 0 012 14.75z
                                                                                    " />

                            </svg>

                        </button>


                        {{-- =====================================
                             PAGE TITLE
                        ====================================== --}}
                        <h1
                            class="
                                text-lg
                                sm:text-xl

                                font-semibold

                                tracking-tight

                                text-slate-900

                                truncate
                            ">
                            {{ $header }}
                        </h1>

                    </div>


                    {{-- =========================================
                         RIGHT SIDE
                    ========================================== --}}
                    <div
                        class="
                            hidden
                            md:flex

                            items-center

                            gap-3

                            shrink-0
                        ">

                        {{-- =====================================
                             SEARCH
                        ====================================== --}}
                        <form action="{{ route('search') }}" method="GET" class="relative">

                            {{-- Search Icon --}}
                            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">

                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />

                            </svg>

                            <input type="text" name="q" value="{{ request('q') }}"
                                placeholder="Cari menu, data bangunan, audit..."
                                class="
            w-48
            lg:w-64
            pl-10
            pr-4
            py-2
            rounded-2xl
            bg-white/70
            border border-white/80
            text-sm text-slate-700
            placeholder-slate-400
            outline-none
            focus:border-indigo-300
            focus:ring-2 focus:ring-indigo-200/50
            transition
        " />
                        </form>


                        {{-- =====================================
                             NOTIFICATION
                        ====================================== --}}
                        {{-- =====================================
     NOTIFICATION
====================================== --}}
                        <button id="notification-button" data-dropdown-toggle="notification-dropdown"
                            data-dropdown-placement="bottom-end" type="button"
                            class="
        relative
        w-10 h-10
        rounded-2xl
        bg-white/70
        border border-white/80
        flex items-center justify-center
        text-slate-500
        hover:bg-white
        hover:text-indigo-600
        transition
    ">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0h6z" />
                            </svg>

                            {{-- Notification Dot --}}
                            @if ($headerNotifications->isNotEmpty())
                                <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                            @endif
                        </button>


                        {{-- =====================================
     NOTIFICATION DROPDOWN
====================================== --}}
                        <div id="notification-dropdown"
                            class="z-50 hidden w-80 glass-surface rounded-2xl shadow-xl divide-y divide-slate-200">

                            <div class="px-4 py-3 flex items-center justify-between">
                                <h3 class="text-sm font-semibold text-slate-900">
                                    Notifikasi
                                </h3>

                                <span class="text-xs text-indigo-600 font-medium">
                                    {{ $headerNotifications->count() }} terbaru
                                </span>
                            </div>

                            <div class="max-h-80 overflow-y-auto divide-y divide-slate-100">

                                @forelse ($headerNotifications as $notification)
                                    <a href="{{ route('audits.show', $notification) }}" class="block px-4 py-3 transition hover:bg-white/70">
                                        <p class="text-sm font-medium text-slate-800">Audit {{ $notification->nomor_audit }} selesai diproses</p>
                                        <p class="mt-1 text-xs text-slate-500">{{ $notification->building->nama_bangunan ?? 'Bangunan' }} · {{ $notification->created_at->diffForHumans() }}</p>
                                    </a>
                                @empty
                                    <p class="px-4 py-6 text-center text-sm text-slate-500">Belum ada notifikasi.</p>
                                @endforelse

                            </div>

                            <a href="{{ route('audits.index') }}"
                                class="block px-4 py-3 text-center text-sm font-medium text-indigo-600 hover:bg-white/70 rounded-b-2xl transition">
                                Lihat semua notifikasi
                            </a>
                        </div>

                    </div>

                </header>
            @endisset


            {{-- =================================================
                 MAIN CONTENT

                 Background tetap #eef5ff.
            ================================================== --}}
            <main class="flex-1 overflow-y-auto overflow-x-hidden vscode-scroll p-4 sm:p-6 lg:p-8">

                @hasSection('content')
                    @yield('content')
                @else
                    {{ $slot ?? '' }}
                @endif

            </main>

        </div>

    </div>


    {{-- =====================================================
         STACKED SCRIPTS
    ====================================================== --}}
    @stack('scripts')

</body>

</html>
