<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AlateeBuildIt</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-slate-100 text-slate-800" @click="closeUserMenu">

    <div id="app" class="min-h-screen flex flex-col">

        {{-- =========================
        NAVBAR
    ========================== --}}

        <nav class="sticky top-0 z-40 bg-white/90 backdrop-blur-lg border-b border-slate-200 shadow-sm">

            <div class="max-w-7xl mx-auto px-6">

                <div class="h-16 flex items-center justify-between">

                    {{-- LOGO --}}
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">

                        <div
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-700 flex items-center justify-center text-white font-bold text-lg">

                            A

                        </div>

                        <div>

                            <h1 class="font-bold text-slate-900 leading-none">

                                LateeBuildIt

                            </h1>

                            <p class="text-xs text-slate-500">

                                Audit Bangunan & RAB

                            </p>

                        </div>

                    </a>

                    {{-- Mobile Button --}}
                    <button @click="toggleMobileMenu" class="md:hidden p-2 rounded-lg hover:bg-slate-100 transition">

                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                d="M4 6h16M4 12h16M4 18h16" />

                        </svg>

                    </button>

                    {{-- MENU --}}
                    <div class="hidden md:flex items-center gap-2">

                        {{-- Dashboard --}}
                        <a href="{{ route('dashboard') }}"
                            class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('dashboard') ? 'bg-emerald-100 text-emerald-700' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-700' }}">

                            Dashboard

                        </a>

                        {{-- Audit --}}
                        <a href="{{ route('audits.index') }}"
                            class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('audits.*') ? 'bg-emerald-100 text-emerald-700' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-700' }}">

                            Audit

                        </a>

                        {{-- RAB --}}
                        <a href="{{ route('rabs.index') }}"
                            class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('rabs.*') ? 'bg-emerald-100 text-emerald-700' : 'text-slate-600 hover:bg-emerald-50 hover:text-emerald-700' }}">

                            RAB

                        </a>

                        {{-- USER DROPDOWN --}}
                        <div class="relative">

                            {{-- BUTTON USER --}}
                            <button type="button" @click.stop="userMenu = !userMenu"
                                class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-slate-100 transition">

                                {{-- Avatar --}}
                                <div
                                    class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-emerald-700 text-white flex items-center justify-center font-bold">

                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                                </div>

                                {{-- Nama --}}
                                <div class="hidden md:block text-left">

                                    <p class="text-sm font-semibold text-slate-800">

                                        {{ Auth::user()->name }}

                                    </p>

                                    <p class="text-xs text-slate-500">

                                        {{ ucfirst(Auth::user()->role) }}

                                    </p>

                                </div>

                                {{-- Arrow --}}
                                <svg class="w-4 h-4 text-slate-500 transition" :class="userMenu ? 'rotate-180' : ''"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 9l-7 7-7-7" />

                                </svg>

                            </button>

                            {{-- DROPDOWN --}}
                            <div v-show="userMenu"
                                class="absolute right-0 mt-3 w-60 bg-white rounded-xl shadow-xl border border-slate-200 overflow-hidden z-50">

                                {{-- USER INFO --}}
                                <div class="px-4 py-4 border-b">

                                    <p class="font-semibold text-slate-800">

                                        {{ Auth::user()->name }}

                                    </p>

                                    <p class="text-xs text-slate-500">

                                        {{ ucfirst(Auth::user()->role) }}

                                    </p>

                                </div>

                                {{-- PROFILE --}}
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100 transition">

                                    ⚙️ Profil

                                </a>

                                {{-- LOGOUT --}}
                                <form method="POST" action="{{ route('logout') }}">

                                    @csrf

                                    <button type="submit"
                                        class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">

                                        🚪 Logout

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </nav>

        {{-- MOBILE MENU --}}

        <Transition name="mobile">

            <div v-show="sidebarOpen">

                <div class="px-6 py-4 space-y-2">

                    <a href="{{ route('dashboard') }}"
                        class="block px-4 py-3 rounded-xl text-sm font-semibold hover:bg-emerald-50">

                        🏠 Dashboard

                    </a>

                    <a href="{{ route('audits.index') }}"
                        class="block px-4 py-3 rounded-xl text-sm font-semibold hover:bg-emerald-50">

                        🏢 Audit

                    </a>

                    <a href="{{ route('rabs.index') }}"
                        class="block px-4 py-3 rounded-xl text-sm font-semibold hover:bg-emerald-50">

                        💰 RAB

                    </a>

                    <div class="border-t my-3"></div>

                    <div class="px-4 py-2">

                        <p class="font-semibold">

                            {{ Auth::user()->name }}

                        </p>

                        <p class="text-xs text-slate-500">

                            {{ ucfirst(Auth::user()->role) }}

                        </p>

                    </div>

                    <a href="{{ route('profile.edit') }}" class="block px-4 py-3 rounded-xl hover:bg-slate-100">

                        ⚙ Profil

                    </a>

                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50 rounded-xl">

                            🚪 Logout

                        </button>

                    </form>

                </div>

            </div>

        </Transition>

        {{-- =========================
        CONTENT
    ========================== --}}

        <main class="flex-1">

            <div class="max-w-7xl mx-auto px-6 py-8">

                @yield('content')

            </div>

        </main>

        {{-- FOOTER --}}
        <footer class="border-t bg-white text-center py-5 text-sm text-slate-500">

            © {{ date('Y') }}

            <span class="font-semibold">

                AlateeBuildIt

            </span>

            • Sistem Audit Bangunan & RAB

        </footer>

    </div>

</body>

</html>
