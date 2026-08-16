<x-app-layout>

    {{-- =========================================
         HEADER
    ========================================== --}}
    <x-slot name="header">
        Dashboard Admin
    </x-slot>

    {{-- =========================================
         STATISTIK UTAMA
    ========================================== --}}
    <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.28em] text-emerald-600">Pusat kendali</p>
            <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">Ringkasan Sistem</h1>
            <p class="mt-1 text-sm text-slate-500">Pantau data audit, klasifikasi, dan anggaran dalam satu tampilan.</p>
        </div>
        <span class="inline-flex w-fit items-center gap-2 rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700"><span class="h-2 w-2 rounded-full bg-emerald-500"></span> Data sistem aktif</span>
    </div>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4 mb-8">

        {{-- TOTAL BANGUNAN --}}
        <div class="group relative overflow-hidden rounded-[24px] border border-blue-100/90 bg-white/90 p-5 shadow-[0_12px_30px_rgba(37,99,235,0.08)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_35px_rgba(37,99,235,0.14)]">
            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-blue-500 via-sky-400 to-transparent"></div>
            <div class="absolute -right-8 -top-10 h-28 w-28 rounded-full bg-blue-100/70 blur-2xl transition duration-300 group-hover:scale-125"></div>
            <div class="relative flex items-start justify-between gap-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Bangunan</p>
                    <h3 class="mt-3 text-4xl font-extrabold tracking-tight text-slate-900">{{ number_format($totalBangunan, 0, ',', '.') }}</h3>
                    <p class="mt-2 text-sm text-slate-500">Fasilitas terdaftar</p>
                </div>
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-600 text-white shadow-lg shadow-blue-500/25 transition duration-300 group-hover:scale-110 group-hover:rotate-3">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5M9 10h.01M15 10h.01" /></svg>
                </div>
            </div>
            <div class="relative mt-5 flex items-center gap-2 border-t border-blue-50 pt-3 text-xs font-medium text-blue-700"><span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span> Basis data aset</div>
        </div>

        {{-- TOTAL AUDIT --}}
        <div class="group relative overflow-hidden rounded-[24px] border border-amber-100/90 bg-white/90 p-5 shadow-[0_12px_30px_rgba(245,158,11,0.08)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_35px_rgba(245,158,11,0.14)]">
            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-amber-500 via-orange-400 to-transparent"></div>
            <div class="absolute -right-8 -top-10 h-28 w-28 rounded-full bg-amber-100/70 blur-2xl transition duration-300 group-hover:scale-125"></div>
            <div class="relative flex items-start justify-between gap-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Total Audit</p>
                    <h3 class="mt-3 text-4xl font-extrabold tracking-tight text-slate-900">{{ number_format($totalAudit, 0, ',', '.') }}</h3>
                    <p class="mt-2 text-sm text-slate-500">Pemeriksaan bangunan</p>
                </div>
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-amber-500 text-white shadow-lg shadow-amber-500/25 transition duration-300 group-hover:scale-110 group-hover:rotate-3">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5h6M9 3h6a2 2 0 012 2v14a2 2 0 01-2 2H9a2 2 0 01-2-2V5a2 2 0 012-2Zm0 0v2h6V3M10 12h4m-4 4h4" /></svg>
                </div>
            </div>
            <div class="relative mt-5 flex items-center gap-2 border-t border-amber-50 pt-3 text-xs font-medium text-amber-700"><span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span> Riwayat pemeriksaan</div>
        </div>

        {{-- DATASET KNN --}}
        <div class="group relative overflow-hidden rounded-[24px] border border-violet-100/90 bg-white/90 p-5 shadow-[0_12px_30px_rgba(124,58,237,0.08)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_35px_rgba(124,58,237,0.14)]">
            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-violet-500 via-fuchsia-400 to-transparent"></div>
            <div class="absolute -right-8 -top-10 h-28 w-28 rounded-full bg-violet-100/70 blur-2xl transition duration-300 group-hover:scale-125"></div>
            <div class="relative flex items-start justify-between gap-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Dataset KNN</p>
                    <h3 class="mt-3 text-4xl font-extrabold tracking-tight text-slate-900">{{ number_format($totalData, 0, ',', '.') }}</h3>
                    <p class="mt-2 text-sm text-slate-500">Data latih algoritma</p>
                </div>
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-violet-600 text-white shadow-lg shadow-violet-500/25 transition duration-300 group-hover:scale-110 group-hover:rotate-3">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3a3 3 0 00-3 3c0 .57.16 1.1.44 1.56A4.5 4.5 0 006 12v1.5A4.5 4.5 0 0010.5 18h3a4.5 4.5 0 004.5-4.5V12a4.5 4.5 0 00-3.44-4.44A3 3 0 0012 3Zm-2.5 9h.01m4.99 0h.01M10 15h4" /></svg>
                </div>
            </div>
            <div class="relative mt-5 flex items-center gap-2 border-t border-violet-50 pt-3 text-xs font-medium text-violet-700"><span class="h-1.5 w-1.5 rounded-full bg-violet-500"></span> Referensi klasifikasi</div>
        </div>

        {{-- TOTAL RAB --}}
        <div class="group relative overflow-hidden rounded-[24px] border border-emerald-100/90 bg-white/90 p-5 shadow-[0_12px_30px_rgba(16,185,129,0.08)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_35px_rgba(16,185,129,0.14)]">
            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-emerald-500 via-teal-400 to-transparent"></div>
            <div class="absolute -right-8 -top-10 h-28 w-28 rounded-full bg-emerald-100/70 blur-2xl transition duration-300 group-hover:scale-125"></div>
            <div class="relative flex items-start justify-between gap-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Total RAB</p>
                    <h3 class="mt-3 text-4xl font-extrabold tracking-tight text-slate-900">{{ number_format($totalRab, 0, ',', '.') }}</h3>
                    <p class="mt-2 text-sm text-slate-500">Estimasi biaya dibuat</p>
                </div>
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg shadow-emerald-500/25 transition duration-300 group-hover:scale-110 group-hover:rotate-3">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m4-8.5c0-1.38-1.79-2.5-4-2.5s-4 1.12-4 2.5 1.79 2.5 4 2.5 4 1.12 4 2.5-1.79 2.5-4 2.5-4-1.12-4-2.5" /></svg>
                </div>
            </div>
            <div class="relative mt-5 flex items-center gap-2 border-t border-emerald-50 pt-3 text-xs font-medium text-emerald-700"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Anggaran tercatat</div>
        </div>

    </div>

    {{-- =========================================
         HERO FINANSIAL
    ========================================== --}}
    <div
        class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-indigo-600 via-blue-600 to-violet-600 p-8 text-white shadow-2xl shadow-indigo-500/25 mb-8">

        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.25),transparent_40%)]">
        </div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <div class="max-w-2xl">

                <span
                    class="inline-flex items-center px-3 py-1 rounded-full bg-white/15 text-white text-xs font-semibold backdrop-blur">

                    Ringkasan Finansial

                </span>

                <h3 class="text-2xl lg:text-3xl font-bold mt-5 leading-tight">

                    Total Estimasi Anggaran Bangunan

                </h3>

                <p class="text-indigo-100 mt-3 leading-relaxed">

                    Sistem menghitung seluruh estimasi Rencana Anggaran Biaya berdasarkan hasil audit dan kebutuhan
                    perbaikan bangunan.

                </p>

            </div>

            <div class="glass-surface rounded-[24px] px-8 py-6 min-w-[260px] text-right">

                <p class="text-sm font-medium text-slate-500">

                    Total Nilai RAB

                </p>

                <h2 class="text-3xl font-extrabold text-slate-900 mt-2">

                    Rp {{ number_format($totalBiayaSemuaRab, 0, ',', '.') }}

                </h2>

            </div>

        </div>

    </div>

    {{-- =========================================
         AREA GRAFIK
    ========================================== --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">

        {{-- STATISTIK --}}
        <div class="glass-surface rounded-[28px] p-6 xl:col-span-2">

            <div class="mb-6 flex items-start justify-between gap-4">

                <div>

                    <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-blue-500 shadow-[0_0_0_4px_rgba(59,130,246,0.12)]"></span><h3 class="text-lg font-bold text-slate-900">

                        Statistik Sistem

                    </h3></div>

                    <p class="text-sm text-slate-500">

                        Perbandingan jumlah data utama

                    </p>

                </div>

                <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-600"><svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19V5m0 14h16M8 16v-5m4 5V7m4 9v-8" /></svg></span>

            </div>

            <div class="mb-4 grid grid-cols-2 gap-3 sm:grid-cols-4">
                <div class="rounded-2xl bg-blue-50/70 px-3 py-2"><p class="text-[10px] font-bold uppercase tracking-wider text-blue-600">Bangunan</p><p class="mt-1 text-lg font-extrabold text-slate-900">{{ number_format($totalBangunan, 0, ',', '.') }}</p></div>
                <div class="rounded-2xl bg-amber-50/70 px-3 py-2"><p class="text-[10px] font-bold uppercase tracking-wider text-amber-600">Audit</p><p class="mt-1 text-lg font-extrabold text-slate-900">{{ number_format($totalAudit, 0, ',', '.') }}</p></div>
                <div class="rounded-2xl bg-violet-50/70 px-3 py-2"><p class="text-[10px] font-bold uppercase tracking-wider text-violet-600">KNN</p><p class="mt-1 text-lg font-extrabold text-slate-900">{{ number_format($totalData, 0, ',', '.') }}</p></div>
                <div class="rounded-2xl bg-emerald-50/70 px-3 py-2"><p class="text-[10px] font-bold uppercase tracking-wider text-emerald-600">RAB</p><p class="mt-1 text-lg font-extrabold text-slate-900">{{ number_format($totalRab, 0, ',', '.') }}</p></div>
            </div>
            <div class="h-64 sm:h-72">

                <canvas id="statistikChart"></canvas>

            </div>

        </div>

        {{-- KNN --}}
        <div class="glass-surface rounded-[28px] p-6">

            <div class="mb-5 flex items-start justify-between gap-4">

                <div>

                    <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-violet-500 shadow-[0_0_0_4px_rgba(139,92,246,0.12)]"></span><h3 class="text-lg font-bold text-slate-900">

                        Hasil Klasifikasi KNN

                    </h3></div>

                    <p class="text-sm text-slate-500">

                        Distribusi tingkat kelayakan bangunan

                    </p>

                </div>

                <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-violet-50 text-violet-600"><svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3a9 9 0 100 18 9 9 0 000-18Zm0 0v9l6 3" /></svg></span>

            </div>

            <div class="relative mb-5 h-56">

                <canvas id="knnChart"></canvas>
                <div class="pointer-events-none absolute inset-0 flex flex-col items-center justify-center"><span class="text-3xl font-extrabold text-slate-900">{{ number_format(array_sum($knnChart), 0, ',', '.') }}</span><span class="mt-1 text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">Total audit</span></div>

            </div>

            <div class="space-y-2">

                @foreach ($knnChart as $label => $jumlah)
                    <div class="flex items-center justify-between rounded-2xl border border-slate-100/80 bg-white/60 px-4 py-2.5 transition hover:bg-white">

                        <span class="flex items-center gap-2 text-sm font-medium text-slate-700"><span class="h-2.5 w-2.5 rounded-full {{ $loop->index === 0 ? 'bg-emerald-500' : ($loop->index === 1 ? 'bg-amber-500' : 'bg-rose-500') }}"></span>

                            {{ $label }}

                        </span>

                        <span class="text-sm font-bold text-slate-900">

                            {{ $jumlah }} Data

                        </span>

                    </div>
                @endforeach

            </div>

        </div>

    </div>

    {{-- =========================================
         GRAFIK RAB
    ========================================== --}}
    <div class="glass-surface rounded-[28px] p-6 mb-8">

        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

            <div>

                <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-500 shadow-[0_0_0_4px_rgba(16,185,129,0.12)]"></span><h3 class="text-lg font-bold text-slate-900">

                    Perkembangan Anggaran RAB

                </h3></div>

                <p class="text-sm text-slate-500">

                    Total nilai RAB berdasarkan bulan

                </p>

            </div>

            <div class="flex items-center gap-3 rounded-2xl border border-emerald-100 bg-emerald-50/70 px-4 py-2.5"><span class="text-xs font-semibold text-emerald-700">Total anggaran</span><span class="text-sm font-extrabold text-emerald-800">Rp {{ number_format($totalBiayaSemuaRab, 0, ',', '.') }}</span></div>

        </div>

        <div class="h-72 sm:h-80">

            <canvas id="rabChart"></canvas>

        </div>

    </div>

    {{-- =========================================
         SCRIPT CHART
    ========================================== --}}
    @push('scripts')
        <script>
            window.dashboardData = {

                statistik: @json($statistik),

                bulan: @json($bulan),

                grafikRab: @json($grafikRab),

                knn: @json($knnChart),

            };
        </script>

        @vite('resources/js/dashboard.js')
    @endpush

</x-app-layout>
