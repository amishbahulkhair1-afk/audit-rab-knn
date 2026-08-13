<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800">
                    Dashboard Sistem Audit Bangunan
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Monitoring audit kelayakan bangunan dan estimasi RAB
                </p>
            </div>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- ==========================================
                STATISTIK UTAMA
            =========================================== --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                {{-- TOTAL BANGUNAN --}}
                <div
                    class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-lg transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Bangunan
                            </p>
                            <h3 class="text-3xl font-extrabold text-slate-900 mt-3">
                                {{ $totalBangunan }}
                            </h3>
                            <p class="text-sm text-slate-500 mt-2">
                                Data fasilitas bangunan
                            </p>
                        </div>
                        <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5" />
                            </svg>
                        </div>
                    </div>
                </div>
                {{-- TOTAL AUDIT --}}
                <div
                    class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-lg transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Total Audit
                            </p>
                            <h3 class="text-3xl font-extrabold text-slate-900 mt-3">
                                {{ $totalAudit }}
                            </h3>
                            <p class="text-sm text-slate-500 mt-2">
                                Pemeriksaan bangunan
                            </p>
                        </div>
                        <div class="w-14 h-14 rounded-xl bg-amber-50 flex items-center justify-center">
                            <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0" />
                            </svg>
                        </div>
                    </div>
                </div>
                {{-- DATA TRAINING KNN --}}
                <div
                    class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-lg transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Dataset KNN
                            </p>
                            <h3 class="text-3xl font-extrabold text-slate-900 mt-3">
                                {{ $totalData }}
                            </h3>
                            <p class="text-sm text-slate-500 mt-2">
                                Dataset algoritma
                            </p>
                        </div>
                        <div class="w-14 h-14 rounded-xl bg-purple-50 flex items-center justify-center">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </div>
                    </div>
                </div>
                {{-- TOTAL RAB --}}
                <div
                    class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-lg transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Total RAB
                            </p>
                            <h3 class="text-3xl font-extrabold text-slate-900 mt-3">
                                {{ $totalRab }}
                            </h3>
                            <p class="text-sm text-slate-500 mt-2">
                                Estimasi biaya pembangunan
                            </p>
                        </div>
                        <div class="w-14 h-14 rounded-xl bg-emerald-50 flex items-center justify-center">
                            <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2
                                    3 .895 3 2-1.343 2-3 2m0-8v8" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ==========================================
                TOTAL ANGGARAN
            =========================================== --}}
            <div class="bg-gradient-to-r from-slate-900 to-slate-800 rounded-2xl p-8 mb-8 text-white shadow-lg">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <span
                            class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-400">
                            Ringkasan Finansial
                        </span>
                        <h3 class="text-2xl font-bold mt-4">
                            Total Estimasi Anggaran Bangunan
                        </h3>
                        <p class="text-slate-300 mt-2 max-w-xl">
                            Sistem menghitung seluruh estimasi Rencana Anggaran
                            Biaya berdasarkan hasil audit dan kebutuhan perbaikan bangunan.
                        </p>
                    </div>
                    <div class="bg-white/10 rounded-xl px-8 py-5 text-right">
                        <p class="text-sm text-slate-300">
                            Total Nilai RAB
                        </p>
                        <h2 class="text-3xl font-extrabold text-emerald-400 mt-2">
                            Rp {{ number_format($totalBiayaSemuaRab, 0, ',', '.') }}
                        </h2>
                    </div>
                </div>
            </div>
            {{-- ==========================================
    AREA GRAFIK
=========================================== --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                {{-- BAR CHART STATISTIK --}}

                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <div class="flex items-center justify-between mb-5">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">
                                Statistik Sistem
                            </h3>
                            <p class="text-sm text-slate-500">
                                Perbandingan jumlah data utama
                            </p>
                        </div>
                    </div>
                    <div class="h-80">
                        <canvas id="statistikChart"></canvas>
                    </div>
                </div>
                {{-- LINE CHART RAB --}}

                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <div class="mb-5">
                        <h3 class="text-lg font-bold text-slate-800">
                            Perkembangan Anggaran RAB
                        </h3>
                        <p class="text-sm text-slate-500">
                            Total nilai RAB berdasarkan bulan
                        </p>
                    </div>
                    <div class="h-80">
                        <canvas id="rabChart"></canvas>
                    </div>
                </div>
            </div>
            {{-- PIE CHART KNN --}}

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-8">
                <div class="mb-5">
                    <h3 class="text-lg font-bold text-slate-800">
                        Hasil Klasifikasi KNN
                    </h3>
                    <p class="text-sm text-slate-500">
                        Distribusi tingkat kelayakan bangunan berdasarkan audit
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div class="h-80">
                        <canvas id="knnChart"></canvas>
                    </div>
                    <div>
                        @foreach ($knnChart as $label => $jumlah)
                            <div class="flex items-center justify-between border-b border-slate-100 py-3">
                                <span class="font-medium text-slate-700">
                                    {{ $label }}
                                </span>
                                <span class="font-bold text-slate-900">
                                    {{ $jumlah }} Data
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            window.dashboardData = {
                statistik: @json($statistik),
                bulan: @json($bulan),
                grafikRab: @json($grafikRab),
                knn: @json($knnChart)
            };
        </script>
        @vite('resources/js/dashboard.js')
    @endpush
</x-app-layout>
