@extends('layouts.user')

@section('content')
    <div class="space-y-8">

        {{-- =========================================================
        PROFILE HEADER
    ========================================================== --}}

        <div class="bg-gradient-to-r from-emerald-700 to-emerald-500 rounded-3xl p-8 text-white shadow-lg">

            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">

                {{-- Avatar --}}

                <div
                    class="w-24 h-24 rounded-3xl bg-white/20 backdrop-blur-md flex items-center justify-center text-4xl font-bold shadow">

                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                </div>

                {{-- User Information --}}

                <div class="text-center md:text-left">

                    <span class="inline-block bg-white/20 px-3 py-1 rounded-full text-xs font-semibold mb-3">

                        {{ Auth::user()->role == 'pengurus_pu' ? 'Pengurus PU' : 'Administrator' }}

                    </span>

                    <h1 class="text-3xl font-bold">

                        {{ Auth::user()->name }}

                    </h1>

                    <p class="text-emerald-50 mt-2">

                        {{ Auth::user()->email }}

                    </p>

                    <p class="text-sm text-emerald-100 mt-3">

                        Kelola informasi akun dan keamanan
                        sistem Anda.

                    </p>

                </div>

            </div>

        </div>

        {{-- =========================================================
        PROFILE INFORMATION
    ========================================================== --}}

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

            <div class="p-8">

                @include('profile.partials.update-profile-information-form')

            </div>

        </div>

        {{-- =========================================================
        ZOOM INTERFACE
    ========================================================== --}}

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8">
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl">
                        🔍
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Zoom Antarmuka</h2>
                        <p class="text-sm text-slate-500 mt-1">
                            Atur ukuran tampilan aplikasi sesuai kenyamanan Anda.
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-2">
                    @foreach ([80, 90, 100, 110, 125] as $zoomLevel)
                        <button type="button" data-profile-zoom="{{ $zoomLevel }}"
                            class="rounded-xl border border-slate-200 bg-white px-4 py-2 font-medium text-slate-700 transition hover:bg-slate-50">
                            {{ $zoomLevel }}%
                        </button>
                    @endforeach
                </div>

                <p class="mt-4 text-xs text-slate-400">Pengaturan zoom tersimpan otomatis di browser Anda.</p>
            </div>
        </div>

        {{-- =========================================================
        PASSWORD
    ========================================================== --}}

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8">

                @include('profile.partials.update-password-form')

            </div>

        </div>

        {{-- =========================================================
        DELETE ACCOUNT (OPTIONAL)
    ========================================================== --}}

        @if (Auth::user()->role == 'admin')
            <div class="bg-white rounded-2xl border border-red-100 shadow-sm overflow-hidden">

                <div class="p-6 border-b border-red-100">

                </div>

                <div class="p-8">

                    @include('profile.partials.delete-user-form')

                </div>

            </div>
        @endif

    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const buttons = document.querySelectorAll('[data-profile-zoom]');

            const setZoom = (value) => {
                const zoom = Number(value);
                if (!Number.isFinite(zoom)) return;

                document.documentElement.style.fontSize = `${zoom}%`;
                localStorage.setItem('app_zoom', String(zoom));

                buttons.forEach((button) => {
                    const active = Number(button.dataset.profileZoom) === zoom;
                    button.classList.toggle('bg-emerald-600', active);
                    button.classList.toggle('border-emerald-600', active);
                    button.classList.toggle('text-white', active);
                    button.classList.toggle('bg-white', !active);
                    button.classList.toggle('border-slate-200', !active);
                    button.classList.toggle('text-slate-700', !active);
                });
            };

            buttons.forEach((button) => {
                button.addEventListener('click', () => setZoom(button.dataset.profileZoom));
            });

            setZoom(parseInt(localStorage.getItem('app_zoom') || '90', 10) || 90);
        });
    </script>
@endpush
