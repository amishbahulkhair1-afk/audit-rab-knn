<x-app-layout>

    <x-slot name="header">
        Detail AHSP
    </x-slot>

    <div class="space-y-5">

        {{-- =========================================
             HERO / HEADER CARD
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 p-5 md:p-6 text-white shadow-xl">

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
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-semibold uppercase tracking-[0.35em] text-white/70">
                                Master Data
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full bg-white/20 text-white text-[10px] font-bold font-mono">
                                {{ $ahsp->kode }}
                            </span>
                        </div>
                        <h1 class="text-xl md:text-2xl font-bold leading-tight">
                            {{ $ahsp->nama_pekerjaan }}
                        </h1>
                        <p class="text-xs md:text-sm text-white/80 mt-1">
                            Rincian koefisien bahan material, upah kerja, dan alat per satuan {{ $ahsp->satuan }}.
                        </p>
                    </div>

                </div>

                <div class="flex items-center gap-2 self-start sm:self-center">
                    <a href="{{ route('ahsps.edit', $ahsp->id) }}"
                        class="inline-flex items-center justify-center gap-1.5 rounded-2xl bg-white text-emerald-600 px-4 py-2.5 text-xs font-semibold shadow-md hover:bg-slate-50 transition whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Rincian
                    </a>
                    <a href="{{ route('ahsps.index') }}"
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
             ALERT
        ========================================== --}}
        @if (session('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- =========================================
             SUMMARY CARDS
        ========================================== --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

            <div class="glass-surface rounded-3xl p-5">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kode AHSP</p>
                <p class="mt-2 text-lg font-bold font-mono text-slate-800">{{ $ahsp->kode ?? '-' }}</p>
            </div>

            <div class="glass-surface rounded-3xl p-5">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Satuan Pengukuran</p>
                <div class="mt-2">
                    <span class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 border border-blue-100">
                        Per {{ $ahsp->satuan }}
                    </span>
                </div>
            </div>

            <div class="glass-surface rounded-3xl p-5 bg-emerald-50/50 border-emerald-100">
                <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Total Harga Satuan</p>
                <p class="mt-2 text-2xl font-bold text-emerald-700">
                    Rp {{ number_format($ahsp->harga_satuan ?? 0, 0, ',', '.') }}
                </p>
            </div>

        </div>

        {{-- =========================================
             TABLE DETAIL KOEFISIEN
        ========================================== --}}
        <div class="glass-surface rounded-3xl overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-200/70 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-900">Rincian Komponen & Koefisien</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Daftar item material, tenaga kerja, dan peralatan yang digunakan.</p>
                </div>
            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full text-sm text-left text-slate-700">

                    <thead class="bg-slate-50/80 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-6 py-4 w-16 text-center">No</th>
                            <th class="px-6 py-4 w-44">Jenis Komponen</th>
                            <th class="px-6 py-4">Uraian / Item Pekerjaan</th>
                            <th class="px-6 py-4 w-40 text-right">Nilai Koefisien</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($ahsp->details as $detail)
                            <tr class="hover:bg-white/60 transition">
                                <td class="px-6 py-4 text-center font-medium text-slate-400">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($detail->jenis === 'material')
                                        <span class="inline-flex items-center rounded-lg px-2.5 py-1 text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                            Material / Bahan
                                        </span>
                                    @elseif($detail->jenis === 'labor')
                                        <span class="inline-flex items-center rounded-lg px-2.5 py-1 text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                            Tenaga Kerja
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-lg px-2.5 py-1 text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            Peralatan
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-semibold text-slate-900">
                                    {{ $detail->nama_item }}
                                </td>
                                <td class="px-6 py-4 text-right font-mono font-bold text-slate-800">
                                    {{ number_format($detail->koefisien, 4, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                                    Belum ada rincian komponen koefisien untuk AHSP ini.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>
