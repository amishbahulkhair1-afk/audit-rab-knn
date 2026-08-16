<x-app-layout>

    <x-slot name="header">
        Detail Pekerja
    </x-slot>

    <div class="space-y-5">

        {{-- =========================================
             HERO / HEADER CARD
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-rose-500 via-pink-500 to-fuchsia-500 p-5 md:p-6 text-white shadow-xl">

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
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-semibold uppercase tracking-[0.35em] text-white/70">
                                Master Data
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full bg-white/20 text-white text-[10px] font-bold font-mono">
                                {{ $labor->kode }}
                            </span>
                        </div>
                        <h1 class="text-xl md:text-2xl font-bold leading-tight">
                            {{ $labor->nama_pekerja }}
                        </h1>
                        <p class="text-xs md:text-sm text-white/80 mt-1">
                            Detail rincian standar biaya upah harian tenaga kerja konstruksi.
                        </p>
                    </div>

                </div>

                <div class="flex items-center gap-2 self-start sm:self-center">
                    <a href="{{ route('labors.edit', $labor->id) }}"
                        class="inline-flex items-center justify-center gap-1.5 rounded-2xl bg-white text-rose-600 px-4 py-2.5 text-xs font-semibold shadow-md hover:bg-slate-50 transition whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Data
                    </a>
                    <a href="{{ route('labors.index') }}"
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

                <!-- Kode Pekerja -->
                <div class="p-5 rounded-2xl bg-white/60 border border-slate-200/70">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Kode Pekerja
                    </p>
                    <p class="mt-2 text-base font-mono font-semibold text-slate-800">
                        {{ $labor->kode }}
                    </p>
                </div>

                <!-- Nama Tenaga Kerja -->
                <div class="p-5 rounded-2xl bg-white/60 border border-slate-200/70">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Nama Tenaga Kerja / Posisi
                    </p>
                    <p class="mt-2 text-base font-semibold text-slate-900">
                        {{ $labor->nama_pekerja }}
                    </p>
                </div>

                <!-- Upah Harian -->
                <div class="md:col-span-2 p-5 rounded-2xl bg-rose-50/60 border border-rose-100">
                    <p class="text-xs font-bold text-rose-500 uppercase tracking-wider">
                        Standar Upah Harian
                    </p>
                    <p class="mt-2 text-2xl font-bold text-rose-700 font-mono">
                        Rp {{ number_format($labor->upah_harian, 0, ',', '.') }}
                        <span class="text-xs font-normal text-rose-500">/ hari kerja</span>
                    </p>
                </div>

            </div>

            <!-- Footer Buttons -->
            <div class="mt-8 pt-6 border-t border-slate-200/60 flex items-center justify-between">
                <a href="{{ route('labors.index') }}"
                    class="px-5 py-2.5 rounded-2xl border border-slate-200 bg-white text-slate-600 text-xs font-semibold hover:bg-slate-50 transition">
                    Kembali ke Daftar
                </a>

                <a href="{{ route('labors.edit', $labor->id) }}"
                    class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-2xl bg-rose-600 text-white text-xs font-semibold hover:bg-rose-700 shadow-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Data Pekerja
                </a>
            </div>

        </div>

    </div>

</x-app-layout>
