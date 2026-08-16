@extends('layouts.app')

@section('header', 'Pengaturan')

@section('content')
    <div class="space-y-6">

        {{-- =====================================================
             TEMA
        ====================================================== --}}
        <div class="glass-surface rounded-3xl p-6">

            <div class="flex items-start gap-4 mb-6">

                <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center">
                    🎨
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-slate-900">
                        Tema Aplikasi
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Pilih tampilan yang nyaman digunakan saat bekerja.
                    </p>
                </div>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                {{-- LIGHT --}}
                <button type="button" onclick="setTheme('light')"
                    class="theme-card p-5 rounded-2xl border border-slate-200 bg-white
                           hover:border-indigo-300 hover:shadow-md transition-all text-left">

                    <div class="text-2xl mb-3">☀️</div>

                    <h3 class="font-medium text-slate-900">
                        Light
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        Tampilan terang untuk penggunaan sehari-hari.
                    </p>

                </button>


                {{-- DARK --}}
                <button type="button" onclick="setTheme('dark')"
                    class="theme-card p-5 rounded-2xl border border-slate-200 bg-white
                           hover:border-indigo-300 hover:shadow-md transition-all text-left">

                    <div class="text-2xl mb-3">🌙</div>

                    <h3 class="font-medium text-slate-900">
                        Dark
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        Tampilan gelap untuk mengurangi silau mata.
                    </p>

                </button>


                {{-- SYSTEM --}}
                <button type="button" onclick="setTheme('system')"
                    class="theme-card p-5 rounded-2xl border border-slate-200 bg-white
                           hover:border-indigo-300 hover:shadow-md transition-all text-left">

                    <div class="text-2xl mb-3">💻</div>

                    <h3 class="font-medium text-slate-900">
                        System
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        Mengikuti pengaturan tema perangkat pengguna.
                    </p>

                </button>

            </div>

        </div>


        {{-- =====================================================
             ZOOM
        ====================================================== --}}
        <div class="glass-surface rounded-3xl p-6">

            <div class="flex items-start gap-4 mb-6">

                <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    🔍
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-slate-900">
                        Zoom Antarmuka
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Perbesar atau perkecil tampilan aplikasi tanpa mengubah zoom browser.
                    </p>
                </div>

            </div>


            {{-- BUTTON ZOOM --}}
            <div class="flex flex-wrap gap-2">

                <button @click="zoom = 80"
                    :class="zoom === 80 ?
                        'bg-indigo-500 text-white border-indigo-500 shadow-lg shadow-indigo-500/20' :
                        'bg-white border-slate-200 hover:bg-slate-50'"
                    class="px-4 py-2 rounded-xl border transition-all duration-200 font-medium">
                    80%
                </button>

                <button @click="zoom = 90"
                    :class="zoom === 90 ?
                        'bg-indigo-500 text-white border-indigo-500 shadow-lg shadow-indigo-500/20' :
                        'bg-white border-slate-200 hover:bg-slate-50'"
                    class="px-4 py-2 rounded-xl border transition-all duration-200 font-medium">
                    90%
                </button>

                <button @click="zoom = 100"
                    :class="zoom === 100 ?
                        'bg-indigo-500 text-white border-indigo-500 shadow-lg shadow-indigo-500/20' :
                        'bg-white border-slate-200 hover:bg-slate-50'"
                    class="px-4 py-2 rounded-xl border transition-all duration-200 font-medium">
                    100%
                </button>

                <button @click="zoom = 110"
                    :class="zoom === 110 ?
                        'bg-indigo-500 text-white border-indigo-500 shadow-lg shadow-indigo-500/20' :
                        'bg-white border-slate-200 hover:bg-slate-50'"
                    class="px-4 py-2 rounded-xl border transition-all duration-200 font-medium">
                    110%
                </button>

                <button @click="zoom = 125"
                    :class="zoom === 125 ?
                        'bg-indigo-500 text-white border-indigo-500 shadow-lg shadow-indigo-500/20' :
                        'bg-white border-slate-200 hover:bg-slate-50'"
                    class="px-4 py-2 rounded-xl border transition-all duration-200 font-medium">
                    125%
                </button>

            </div>


            <p class="text-xs text-slate-400 mt-4">
                Pengaturan zoom disimpan otomatis di browser pengguna.
            </p>

        </div>

    </div>


    {{-- =====================================================
         SCRIPT
    ====================================================== --}}
    @push('scripts')
        <script>
            // =================================================
            // THEME
            // =================================================
            function setTheme(theme) {
                localStorage.setItem('app-theme', theme);

                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                } else if (theme === 'light') {
                    document.documentElement.classList.remove('dark');
                } else {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    document.documentElement.classList.toggle('dark', prefersDark);
                }
            }

            // =================================================
            // APPLY SAVED THEME
            // =================================================
            document.addEventListener('DOMContentLoaded', () => {
                const savedTheme = localStorage.getItem('app-theme') || 'system';

                setTheme(savedTheme);
            });
        </script>
    @endpush

@endsection
