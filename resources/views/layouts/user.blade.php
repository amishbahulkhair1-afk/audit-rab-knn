<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="user-layout-root">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LateeBuildIt')</title>
    <script>
        (function () {
            const savedZoom = parseInt(localStorage.getItem('app_zoom') || '90', 10) || 90;
            document.documentElement.style.fontSize = savedZoom + '%';
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="user-portal min-h-screen bg-[#eef5ff] font-sans text-slate-900 antialiased">
    @php($user = auth()->user())

    <div class="min-h-screen bg-transparent">
        <header class="sticky top-0 z-40 border-b border-white/70 bg-white/90 shadow-[0_8px_30px_rgba(15,23,42,.06)] backdrop-blur-xl">
            <div class="flex h-[4.5rem] w-full items-center justify-between gap-4 px-4 sm:px-6 lg:px-10 2xl:px-14">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3" aria-label="Dashboard">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-lg font-extrabold text-white shadow-lg shadow-emerald-500/25">A</span>
                    <span>
                        <span class="block text-base font-extrabold tracking-tight text-slate-900">LateeBuildIt</span>
                        <span class="block text-xs text-slate-500">Audit Bangunan &amp; RAB</span>
                    </span>
                </a>

                <nav class="hidden items-center gap-1 md:flex" aria-label="Navigasi utama">
                    @foreach ([
                        ['route' => 'dashboard', 'label' => 'Dashboard'],
                        ['route' => 'buildings.index', 'label' => 'Bangunan'],
                        ['route' => 'audits.index', 'label' => 'Audit'],
                        ['route' => 'rabs.index', 'label' => 'RAB'],
                    ] as $item)
                        <a href="{{ route($item['route']) }}"
                            class="rounded-xl px-3.5 py-2 text-sm font-semibold transition {{ request()->routeIs(str_replace('.index', '.*', $item['route'])) || request()->routeIs($item['route']) ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="flex items-center gap-2">
                    <div class="relative hidden md:block" data-user-dropdown>
                        <button type="button" data-user-trigger aria-expanded="false"
                            class="flex items-center gap-2 rounded-2xl px-2 py-1.5 transition hover:bg-slate-100">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 text-sm font-bold text-white">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                            <span class="max-w-28 text-left">
                                <span class="block truncate text-sm font-semibold text-slate-800">{{ $user->name }}</span>
                                <span class="block text-xs text-slate-500">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</span>
                            </span>
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6" /></svg>
                        </button>
                        <div data-user-menu class="absolute right-0 mt-2 hidden w-56 overflow-hidden rounded-2xl border border-slate-200 bg-white p-1.5 shadow-xl shadow-slate-900/10">
                            <a href="{{ route('profile.edit') }}" class="block rounded-xl px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="w-full rounded-xl px-3 py-2.5 text-left text-sm font-medium text-rose-600 hover:bg-rose-50">Keluar</button></form>
                        </div>
                    </div>
                    <button type="button" data-mobile-trigger aria-expanded="false" class="rounded-xl p-2 text-slate-600 hover:bg-slate-100 md:hidden" aria-label="Buka menu">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                    </button>
                </div>
            </div>

            <div id="user-mobile-menu" class="hidden border-t border-slate-100 bg-white px-4 py-3 md:hidden">
                <nav class="grid w-full gap-1" aria-label="Navigasi seluler">
                    @foreach ([['route' => 'dashboard', 'label' => 'Dashboard'], ['route' => 'buildings.index', 'label' => 'Bangunan'], ['route' => 'audits.index', 'label' => 'Audit'], ['route' => 'rabs.index', 'label' => 'RAB']] as $item)
                        <a href="{{ route($item['route']) }}" class="rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700">{{ $item['label'] }}</a>
                    @endforeach

                    <div class="mt-1 border-t border-slate-100 pt-2">
                        <a href="{{ route('profile.edit') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">Profil</a>
                        <form method="POST" action="{{ route('logout') }}">@csrf<button class="w-full rounded-xl px-4 py-3 text-left text-sm font-semibold text-rose-600 hover:bg-rose-50">Keluar</button></form>
                    </div>
                </nav>
            </div>
        </header>

        <main class="min-h-[calc(100dvh-9rem)] w-full px-4 py-6 sm:px-6 sm:py-8 lg:px-10 2xl:px-14">
            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                    <p class="font-semibold">Data belum dapat disimpan.</p>
                    <ul class="mt-1 list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif
            @yield('content')
        </main>

        <footer class="mt-8 border-t border-white bg-white/70">
            <div class="w-full px-4 py-5 text-center text-sm text-slate-500 sm:px-6 lg:px-10 2xl:px-14">© {{ date('Y') }} <span class="font-semibold text-slate-700">LateeBuildIt</span> · Sistem Audit Bangunan &amp; RAB</div>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dropdown = document.querySelector('[data-user-dropdown]');
            const trigger = document.querySelector('[data-user-trigger]');
            const menu = document.querySelector('[data-user-menu]');
            const mobileTrigger = document.querySelector('[data-mobile-trigger]');
            const mobileMenu = document.getElementById('user-mobile-menu');

            const closeDropdown = () => { if (menu) menu.classList.add('hidden'); if (trigger) trigger.setAttribute('aria-expanded', 'false'); };

            trigger?.addEventListener('click', (event) => { event.stopPropagation(); menu.classList.toggle('hidden'); trigger.setAttribute('aria-expanded', String(!menu.classList.contains('hidden'))); });
            mobileTrigger?.addEventListener('click', () => { mobileMenu.classList.toggle('hidden'); mobileTrigger.setAttribute('aria-expanded', String(!mobileMenu.classList.contains('hidden'))); });
            document.addEventListener('click', (event) => { if (dropdown && !dropdown.contains(event.target)) closeDropdown(); });
            document.addEventListener('keydown', (event) => { if (event.key === 'Escape') { closeDropdown(); mobileMenu?.classList.add('hidden'); } });

        });
    </script>
    <style>
        .user-portal {
            background:
                radial-gradient(circle at 8% 4%, rgba(16, 185, 129, .16), transparent 27rem),
                radial-gradient(circle at 94% 12%, rgba(45, 212, 191, .16), transparent 23rem),
                linear-gradient(135deg, #f8fafc 0%, #ecfdf5 48%, #f0fdfa 100%);
        }

        .user-portal main { min-height: calc(100dvh - 9rem); }
        .user-portal .bg-white.rounded-2xl,
        .user-portal .bg-white.rounded-xl {
            border-color: rgba(226, 232, 240, .8);
            box-shadow: 0 14px 35px rgba(15, 23, 42, .055);
        }

        .user-portal table thead { background: rgba(248, 250, 252, .9); }
        .user-portal table tbody tr { transition: background-color .18s ease, transform .18s ease; }
        .user-building-card-list { display: block; }
        .user-building-card-list thead { display: none; }
        .user-building-card-list tbody { display: grid; grid-template-columns: repeat(1, minmax(0, 1fr)); gap: 1rem; padding: 1.25rem; }
        .user-building-card-list tbody > tr { display: grid; grid-template-columns: minmax(0, 1fr) auto; gap: .75rem; align-items: center; border: 1px solid rgba(226, 232, 240, .8); border-radius: 1.25rem; padding: 1.25rem; background: #fff; box-shadow: 0 8px 22px rgba(15, 23, 42, .04); }
        .user-building-card-list tbody > tr:hover { border-color: rgba(110, 231, 183, .8); transform: translateY(-2px); }
        .user-building-card-list tbody > tr > td { display: block; padding: 0; }
        .user-building-card-list tbody > tr > td:nth-child(2),
        .user-building-card-list tbody > tr > td:nth-child(3) { color: #64748b; font-size: .875rem; }
        .user-building-card-list tbody > tr > td:nth-child(4) { grid-column: 1 / -1; border-top: 1px solid #f1f5f9; padding-top: .75rem; text-align: left; }
        .user-building-card-list tbody > tr > td:nth-child(4) a,
        .user-building-card-list tbody > tr > td:nth-child(4) button { border-radius: .75rem; background: #f8fafc; padding: .5rem .75rem; font-size: .75rem; }
        .user-building-card-list tbody > tr > td:nth-child(4) a:hover,
        .user-building-card-list tbody > tr > td:nth-child(4) button:hover { background: #ecfdf5; }
        @media (min-width: 768px) {
            .user-building-card-list tbody { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        .user-portal input:not([type="checkbox"]):not([type="radio"]),
        .user-portal select,
        .user-portal textarea {
            border-color: #dbe4ee;
            border-radius: .75rem;
            box-shadow: 0 1px 2px rgba(15, 23, 42, .03);
        }
        .user-portal input:focus,
        .user-portal select:focus,
        .user-portal textarea:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, .12);
        }

        @media (max-width: 639px) {
            .user-portal main { min-height: calc(100vh - 8rem); }
            .user-portal main .p-8 { padding: 1.25rem; }
            .user-portal main .px-6 { padding-left: 1rem; padding-right: 1rem; }
            .user-portal main .py-8 { padding-top: 1.25rem; padding-bottom: 1.25rem; }
            .user-portal main .text-3xl { font-size: 1.75rem; line-height: 2.1rem; }
            .user-portal main .text-2xl { font-size: 1.4rem; line-height: 1.8rem; }
            .user-portal .overflow-x-auto > table { min-width: 42rem; }
            .user-portal .overflow-x-auto { -webkit-overflow-scrolling: touch; }
            .user-portal footer { padding-bottom: calc(1.25rem + env(safe-area-inset-bottom)); }
        }
    </style>
    @stack('scripts')
</body>
</html>
