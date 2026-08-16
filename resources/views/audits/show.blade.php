<x-app-layout>

    <x-slot name="header">
        Detail Audit
    </x-slot>

    <div class="space-y-5">

        {{-- =========================================
             HERO / HEADER CARD
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 p-5 md:p-6 text-white shadow-xl">

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
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-semibold uppercase tracking-[0.35em] text-white/70">
                                Manajemen Audit
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full bg-white/20 text-white text-[10px] font-bold font-mono">
                                {{ $audit->nomor_audit }}
                            </span>
                        </div>
                        <h1 class="text-xl md:text-2xl font-bold leading-tight">
                            Audit: {{ $audit->building->nama_bangunan ?? '-' }}
                        </h1>
                        <p class="text-xs md:text-sm text-white/80 mt-1">
                            Hasil pemeriksaan lapangan, skor komponen, dan klasifikasi kelayakan algoritma K-NN.
                        </p>
                    </div>

                </div>

                <div class="flex flex-wrap items-center gap-2 self-start sm:self-center">
                    <a href="{{ route('audits.pdf', $audit->id) }}" target="_blank"
                        class="inline-flex items-center justify-center gap-1.5 rounded-2xl bg-rose-600 hover:bg-rose-700 text-white px-4 py-2.5 text-xs font-semibold shadow-md transition whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Cetak PDF
                    </a>
                    @if (!$audit->rab)
                        <form action="{{ route('rabs.create-from-audit', $audit->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center justify-center gap-1.5 rounded-2xl bg-white text-amber-700 hover:bg-slate-50 px-4 py-2.5 text-xs font-semibold shadow-md transition whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Buat RAB
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('audits.index') }}"
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
             SUMMARY CARDS
        ========================================== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <div class="glass-surface rounded-3xl p-5">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal Audit</p>
                <p class="mt-2 text-base font-bold text-slate-800">
                    {{ \Carbon\Carbon::parse($audit->tanggal_audit)->translatedFormat('d F Y') }}
                </p>
            </div>

            <div class="glass-surface rounded-3xl p-5">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jenis Konstruksi</p>
                <p class="mt-2 text-base font-semibold text-slate-800">
                    {{ $audit->building->jenis_konstruksi ?? '-' }}
                </p>
            </div>

            <div class="glass-surface rounded-3xl p-5">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Auditor</p>
                <p class="mt-2 text-base font-semibold text-slate-800">
                    {{ $audit->user->name ?? '-' }}
                </p>
            </div>

            <div class="glass-surface rounded-3xl p-5">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Hasil Klasifikasi KNN</p>
                <div class="mt-2">
                    @if ($audit->hasil_knn)
                        @php
                            $hasil = strtolower($audit->hasil_knn);
                            if (str_contains($hasil, 'layak') || str_contains($hasil, 'baik')) {
                                $style = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                            } elseif (str_contains($hasil, 'kurang')) {
                                $style = 'bg-amber-50 text-amber-700 border-amber-200';
                            } else {
                                $style = 'bg-rose-50 text-rose-700 border-rose-200';
                            }
                        @endphp
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $style }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                            {{ $audit->hasil_knn }}
                        </span>
                    @else
                        <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">
                            Belum Diproses
                        </span>
                    @endif
                </div>
            </div>

        </div>

        {{-- =========================================
             INCLUDED PARTIALS (KNN TABLE, SKOR, REKOMENDASI, RAB)
        ========================================== --}}
        <div class="space-y-5">
            @include('audits.partials._knn-table')
            @include('audits.partials._skor-komponen')
            @include('audits.partials._rekomendasi')
            @include('audits.partials._rab')
        </div>

        {{-- =========================================
             FOOTER ACTIONS
        ========================================== --}}
        <div class="glass-surface rounded-3xl p-5 flex items-center justify-between">
            <a href="{{ route('audits.index') }}"
                class="px-5 py-2.5 rounded-2xl border border-slate-200 bg-white text-slate-600 text-xs font-semibold hover:bg-slate-50 transition">
                Kembali ke Daftar Audit
            </a>

            <div class="flex items-center gap-3">
                <a href="{{ route('audits.pdf', $audit->id) }}" target="_blank"
                    class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-2xl bg-rose-600 text-white text-xs font-semibold hover:bg-rose-700 shadow-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Unduh Laporan PDF
                </a>
            </div>
        </div>

    </div>

</x-app-layout>
