<x-app-layout>

    <x-slot name="header">
        Detail Biaya Pendukung
    </x-slot>

    <div class="space-y-5">

        {{-- =========================================
             HERO / HEADER CARD
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-cyan-500 via-sky-500 to-blue-600 p-5 md:p-6 text-white shadow-xl">

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
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-semibold uppercase tracking-[0.35em] text-white/70">
                                Master Data
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full bg-white/20 text-white text-[10px] font-bold font-mono">
                                {{ $support_cost->kode }}
                            </span>
                        </div>
                        <h1 class="text-xl md:text-2xl font-bold leading-tight">
                            {{ $support_cost->nama_biaya }}
                        </h1>
                        <p class="text-xs md:text-sm text-white/80 mt-1">
                            Detail rincian pos biaya tambahan dan operasional pendukung konstruksi.
                        </p>
                    </div>

                </div>

                <div class="flex items-center gap-2 self-start sm:self-center">
                    <a href="{{ route('support-costs.edit', $support_cost) }}"
                        class="inline-flex items-center justify-center gap-1.5 rounded-2xl bg-white text-cyan-600 px-4 py-2.5 text-xs font-semibold shadow-md hover:bg-slate-50 transition whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Data
                    </a>
                    <a href="{{ route('support-costs.index') }}"
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

                <!-- Kode Biaya -->
                <div class="p-5 rounded-2xl bg-white/60 border border-slate-200/70">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Kode Pos Biaya
                    </p>
                    <p class="mt-2 text-base font-mono font-semibold text-slate-800">
                        {{ $support_cost->kode }}
                    </p>
                </div>

                <!-- Nama Biaya -->
                <div class="p-5 rounded-2xl bg-white/60 border border-slate-200/70">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Nama Biaya
                    </p>
                    <p class="mt-2 text-base font-semibold text-slate-900">
                        {{ $support_cost->nama_biaya }}
                    </p>
                </div>

                <!-- Kategori -->
                <div class="p-5 rounded-2xl bg-white/60 border border-slate-200/70">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Kategori
                    </p>
                    <div class="mt-2">
                        <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                            {{ $support_cost->kategori }}
                        </span>
                    </div>
                </div>

                <!-- Harga Satuan -->
                <div class="p-5 rounded-2xl bg-cyan-50/60 border border-cyan-100">
                    <p class="text-xs font-bold text-cyan-600 uppercase tracking-wider">
                        Harga Satuan
                    </p>
                    <p class="mt-2 text-2xl font-bold text-cyan-700 font-mono">
                        Rp {{ number_format($support_cost->harga_satuan, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Keterangan -->
                <div class="md:col-span-2 p-5 rounded-2xl bg-white/60 border border-slate-200/70">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Keterangan
                    </p>
                    <p class="mt-2 text-sm text-slate-700 leading-relaxed">
                        {{ $support_cost->keterangan ?? 'Tidak ada keterangan tambahan.' }}
                    </p>
                </div>

            </div>

            <!-- Footer Buttons -->
            <div class="mt-8 pt-6 border-t border-slate-200/60 flex items-center justify-between">
                <a href="{{ route('support-costs.index') }}"
                    class="px-5 py-2.5 rounded-2xl border border-slate-200 bg-white text-slate-600 text-xs font-semibold hover:bg-slate-50 transition">
                    Kembali ke Daftar
                </a>

                <a href="{{ route('support-costs.edit', $support_cost) }}"
                    class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-2xl bg-cyan-600 text-white text-xs font-semibold hover:bg-cyan-700 shadow-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Data Biaya
                </a>
            </div>

        </div>

    </div>

</x-app-layout>
