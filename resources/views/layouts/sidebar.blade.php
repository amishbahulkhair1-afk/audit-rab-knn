@php
    $user = auth()->user();

    $activeClass =
        'bg-gradient-to-r from-indigo-500 via-blue-500 to-violet-500 text-white shadow-lg shadow-indigo-500/20';

    $normalClass = 'text-slate-600 hover:bg-white/70 hover:text-indigo-600';

    $sectionClass = 'text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500';
@endphp

{{-- =========================================================
     MOBILE OVERLAY
========================================================= --}}
<div id="sidebar-overlay" data-drawer-backdrop="app-sidebar"
    class="fixed inset-0 z-40 hidden bg-[#eaf3ff] backdrop-blur-sm md:hidden">
</div>


{{-- =========================================================
     SIDEBAR
========================================================= --}}
<aside id="app-sidebar"
    class="fixed top-0 left-0 z-50 w-72 h-screen transition-transform -translate-x-full md:translate-x-0"
    aria-label="Sidebar">

    <div
        class="h-full flex flex-col bg-[#eaf3ff] dark:bg-slate-950
border-[#eaf3ff] dark:border-slate-800
transition-colors duration-300">

        {{-- =================================================
             LOGO
        ================================================== --}}
        <div class="h-20 flex items-center px-6 shrink-0">

            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">

                <div
                    class="w-12 h-12 rounded-2xl
                    bg-gradient-to-br from-indigo-500 via-blue-500 to-violet-500
                    flex items-center justify-center
                    text-white font-bold text-lg
                    shadow-lg shadow-indigo-500/25">

                    A

                </div>

                <div>

                    <h1 class="font-bold text-lg text-slate-900 leading-none">
                        LateeBuildIt
                    </h1>

                    <p class="text-xs text-slate-500 mt-1">
                        Audit Bangunan PPA Latee 
                    </p>

                </div>

            </a>

        </div>


        {{-- =================================================
             MENU
        ================================================== --}}
        <div class="flex-1 overflow-y-auto px-4 py-5 sidebar-scroll">

            <nav class="space-y-1 text-sm">


                {{-- =========================================
                     DASHBOARD
                ========================================== --}}
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200
                    {{ request()->routeIs('dashboard') ? $activeClass : $normalClass }}">

                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M3 12l9-9 9 9M5 10v10h14V10M9 20v-6h6v6" />

                    </svg>

                    <span>
                        Dashboard
                    </span>

                </a>


                {{-- =========================================
                     OPERASIONAL
                ========================================== --}}
                <div class="pt-6 pb-2 px-4">

                    <p class="{{ $sectionClass }}">
                        Operasional
                    </p>

                </div>


                {{-- DATA BANGUNAN --}}
                <a href="{{ route('buildings.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200
                    {{ request()->routeIs('buildings.*') ? $activeClass : $normalClass }}">

                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M3 21h18M5 21V5l7-3 7 3v16M9 9h6M9 13h6" />

                    </svg>

                    <span>
                        Data Bangunan
                    </span>

                </a>


                {{-- AUDIT --}}
                <a href="{{ route('audits.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200
                    {{ request()->routeIs('audits.*') ? $activeClass : $normalClass }}">

                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m5-2a9 9 0 11-18 0 9 9 0 0118 0Z" />

                    </svg>

                    <span>
                        Audit Bangunan
                    </span>

                </a>


                {{-- RAB --}}
                <a href="{{ route('rabs.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200
                    {{ request()->routeIs('rabs.*') ? $activeClass : $normalClass }}">

                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />

                    </svg>

                    <span>
                        RAB
                    </span>

                </a>


                {{-- =========================================
                     MASTER DATA
                ========================================== --}}
                @if ($user->role === 'admin')
                    <div class="pt-6 pb-2 px-4">

                        <p class="{{ $sectionClass }}">
                            Master Data
                        </p>

                    </div>


                    {{-- MATERIAL --}}
                    <a href="{{ route('materials.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200
                        {{ request()->routeIs('materials.*') ? $activeClass : $normalClass }}">

                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                d="M4 7h16M4 7l2-3h12l2 3M5 7v13h14V7M9 11h6" />

                        </svg>

                        <span>
                            Material
                        </span>

                    </a>


                    {{-- TENAGA KERJA --}}
                    <a href="{{ route('labors.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200
                        {{ request()->routeIs('labors.*') ? $activeClass : $normalClass }}">

                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8Zm7-3a3 3 0 11-6 0" />

                        </svg>

                        <span>
                            Tenaga Kerja
                        </span>

                    </a>


                    {{-- PERALATAN --}}
                    <a href="{{ route('equipments.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200
                        {{ request()->routeIs('equipments.*') ? $activeClass : $normalClass }}">

                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                d="M20 7h-9M20 12h-9M20 17h-9M4 7h.01M4 12h.01M4 17h.01" />

                        </svg>

                        <span>
                            Peralatan
                        </span>

                    </a>


                    {{-- BIAYA PENDUKUNG --}}
                    <a href="{{ route('support-costs.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200
                        {{ request()->routeIs('support-costs.*') ? $activeClass : $normalClass }}">

                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0Z" />

                        </svg>

                        <span>
                            Biaya Pendukung
                        </span>

                    </a>


                    {{-- AHSP --}}
                    <a href="{{ route('ahsps.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200
                        {{ request()->routeIs('ahsps.*') ? $activeClass : $normalClass }}">

                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3v18M6 7h12M6 17h12" />

                        </svg>

                        <span>
                            AHSP
                        </span>

                    </a>
                @endif

            </nav>

        </div>
        {{-- =================================================
             USER AREA
        ================================================== --}}
        <div class="border-t border-slate-200/70 p-4 shrink-0">

            <button id="user-menu-button" data-dropdown-toggle="user-dropdown" data-dropdown-placement="top"
                type="button"
                class="w-full flex items-center gap-3 p-3 rounded-2xl hover:bg-white/70 transition-all duration-200">

                <div
                    class="w-10 h-10 rounded-full
                    bg-gradient-to-br from-indigo-500 to-violet-500
                    flex items-center justify-center
                    text-white font-bold shrink-0
                    shadow-md">

                    {{ strtoupper(substr($user->name, 0, 1)) }}

                </div>

                <div class="text-left min-w-0 flex-1">

                    <p class="text-sm font-semibold text-slate-900 truncate">
                        {{ $user->name }}
                    </p>

                    <p class="text-xs text-slate-500 capitalize">
                        {{ $user->role }}
                    </p>

                </div>

                <svg class="w-4 h-4 text-slate-500 shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />

                </svg>

            </button>


            {{-- USER DROPDOWN --}}
            <div id="user-dropdown"
                class="z-50 hidden mb-2 glass-surface divide-y divide-slate-200 rounded-2xl shadow-xl w-64">

                <div class="px-4 py-3">

                    <p class="text-sm font-semibold text-slate-900">
                        {{ $user->name }}
                    </p>

                    <p class="text-xs text-slate-500 capitalize mt-1">
                        {{ $user->role }}
                    </p>

                </div>


                <ul class="py-2">

                    <li>

                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-slate-700 hover:bg-white/70 transition-colors duration-200">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />

                            </svg>

                            Profil

                        </a>

                    </li>

                </ul>

                <div class="pt-6 pb-2 px-4">

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Sistem
                    </p>

                </div>

                <a href="{{ route('settings.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200
    {{ request()->routeIs('settings.*') ? $activeClass : $normalClass }}">

                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M10.325 4.317a1.724 1.724 0 013.35 0l.132.527a1.724 1.724 0 002.591 1.066l.463-.264a1.724 1.724 0 012.366.633l.264.463a1.724 1.724 0 01-1.066 2.591l-.527.132a1.724 1.724 0 000 3.35l.527.132a1.724 1.724 0 011.066 2.591l-.264.463a1.724 1.724 0 01-2.366.633l-.463-.264a1.724 1.724 0 00-2.591 1.066l-.132.527a1.724 1.724 0 01-3.35 0l-.132-.527a1.724 1.724 0 00-2.591-1.066l-.463.264a1.724 1.724 0 01-2.366-.633l-.264-.463a1.724 1.724 0 011.066-2.591l.527-.132a1.724 1.724 0 000-3.35l-.527-.132a1.724 1.724 0 01-1.066-2.591l.264-.463a1.724 1.724 0 012.366-.633l.463.264a1.724 1.724 0 002.591-1.066l.132-.527z" />
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                    <span>Pengaturan</span>

                </a>


                <div class="py-2">

                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-500 hover:bg-red-50/70 transition-colors duration-200">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7" />

                            </svg>

                            Logout

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</aside>
