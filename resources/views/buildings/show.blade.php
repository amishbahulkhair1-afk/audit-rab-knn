<x-app-layout>

    <x-slot name="header">
        Detail Bangunan
    </x-slot>

    <div class="space-y-5">

        {{-- =========================================
             HERO / HEADER CARD
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-blue-500 via-indigo-500 to-violet-500 p-5 md:p-6 text-white shadow-xl">

            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.18),transparent_45%)]">
            </div>

            <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div class="flex items-start gap-4">

                    <div
                        class="w-14 h-14 rounded-2xl bg-white/15 border border-white/20 backdrop-blur-sm flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6" />
                        </svg>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-semibold uppercase tracking-[0.35em] text-white/70">
                                Master Data
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full bg-white/20 text-white text-[10px] font-bold font-mono">
                                {{ $building->kode_bangunan }}
                            </span>
                        </div>
                        <h1 class="text-xl md:text-2xl font-bold leading-tight">
                            {{ $building->nama_bangunan }}
                        </h1>
                        <p class="text-xs md:text-sm text-white/80 mt-1">
                            Informasi detail fasilitas bangunan, konstruksi, dan lokasi rayon.
                        </p>
                    </div>

                </div>

                <div class="flex items-center gap-2 self-start sm:self-center">
                    <a href="{{ route('buildings.edit', $building) }}"
                        class="inline-flex items-center justify-center gap-1.5 rounded-2xl bg-white text-blue-600 px-4 py-2.5 text-xs font-semibold shadow-md hover:bg-slate-50 transition whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Bangunan
                    </a>
                    <a href="{{ route('buildings.index') }}"
                        class="inline-flex items-center justify-center gap-1.5 rounded-2xl bg-white/20 hover:bg-white/30 text-white px-4 py-2.5 text-xs font-semibold backdrop-blur-sm border border-white/20 transition whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                </div>

            </div>

        </div>

        {{-- =========================================
             DETAIL CARD
        ========================================== --}}
        <div class="glass-surface rounded-3xl overflow-hidden p-6 md:p-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <!-- Jenis Bangunan -->
                <div class="p-5 rounded-2xl bg-white/60 border border-slate-200/70">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Jenis Bangunan
                    </p>
                    <p class="mt-2 text-base font-semibold text-slate-800">
                        {{ $building->jenis_bangunan ?? '-' }}
                    </p>
                </div>

                <!-- Jenis Konstruksi -->
                <div class="p-5 rounded-2xl bg-white/60 border border-slate-200/70">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Jenis Konstruksi
                    </p>
                    <div class="mt-2">
                        <span class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 border border-blue-100">
                            {{ $building->jenis_konstruksi ?? '-' }}
                        </span>
                    </div>
                </div>

                <!-- Rayon / Wilayah -->
                <div class="p-5 rounded-2xl bg-white/60 border border-slate-200/70">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Rayon / Wilayah
                    </p>
                    <div class="mt-2">
                        <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                            {{ $building->rayon }}
                        </span>
                    </div>
                </div>

                <!-- Tahun Berdiri -->
                <div class="p-5 rounded-2xl bg-white/60 border border-slate-200/70">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Tahun Berdiri
                    </p>
                    <p class="mt-2 text-base font-semibold text-slate-800">
                        {{ $building->tahun_berdiri ?? '-' }}
                    </p>
                </div>

                <!-- Luas Bangunan -->
                <div class="p-5 rounded-2xl bg-emerald-50/60 border border-emerald-100">
                    <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">
                        Luas Bangunan
                    </p>
                    <p class="mt-2 text-2xl font-bold text-emerald-700">
                        {{ $building->luas_bangunan }} m²
                    </p>
                </div>

                <!-- Kode Bangunan -->
                <div class="p-5 rounded-2xl bg-white/60 border border-slate-200/70">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Kode Bangunan
                    </p>
                    <p class="mt-2 text-base font-mono font-semibold text-slate-800">
                        {{ $building->kode_bangunan }}
                    </p>
                </div>

                <!-- Alamat Lengkap -->
                <div class="md:col-span-2 p-5 rounded-2xl bg-white/60 border border-slate-200/70">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Alamat Lokasi Bangunan
                    </p>
                    <p class="mt-2 text-sm text-slate-700 leading-relaxed">
                        {{ $building->alamat ?? 'Tidak ada alamat lengkap yang tercatat.' }}
                    </p>
                </div>

            </div>

            <!-- Footer Buttons -->
            <div class="mt-8 pt-6 border-t border-slate-200/60 flex items-center justify-between">
                <a href="{{ route('buildings.index') }}"
                    class="px-5 py-2.5 rounded-2xl border border-slate-200 bg-white text-slate-600 text-xs font-semibold hover:bg-slate-50 transition">
                    Kembali ke Daftar
                </a>

                <a href="{{ route('buildings.edit', $building) }}"
                    class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-2xl bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700 shadow-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Data Bangunan
                </a>
            </div>

        </div>

    </div>

</x-app-layout>
