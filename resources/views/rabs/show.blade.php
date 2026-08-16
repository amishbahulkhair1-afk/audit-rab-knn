<x-app-layout>

    <x-slot name="header">
        Detail RAB
    </x-slot>

    <div class="space-y-5">

        {{-- =========================================
             HERO / HEADER CARD
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-600 p-5 md:p-6 text-white shadow-xl">

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
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-semibold uppercase tracking-[0.35em] text-white/70">
                                Anggaran
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full bg-white/20 text-white text-[10px] font-bold font-mono">
                                {{ $rab->nomor_rab }}
                            </span>
                        </div>
                        <h1 class="text-xl md:text-2xl font-bold leading-tight">
                            RAB: {{ $rab->audit->building->nama_bangunan ?? '-' }}
                        </h1>
                        <p class="text-xs md:text-sm text-white/80 mt-1">
                            Rincian perhitungan total anggaran biaya perbaikan hasil audit kelayakan bangunan.
                        </p>
                    </div>

                </div>

                <a href="{{ route('rabs.index') }}"
                    class="inline-flex items-center justify-center gap-1.5 rounded-2xl bg-white/20 hover:bg-white/30 text-white px-4 py-2.5 text-xs font-semibold backdrop-blur-sm border border-white/20 transition whitespace-nowrap self-start sm:self-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>

            </div>

        </div>

        {{-- =========================================
             SUMMARY CARDS
        ========================================== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <div class="glass-surface rounded-3xl p-5">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Nama Bangunan</p>
                <p class="mt-2 text-base font-bold text-slate-800">
                    {{ $rab->audit->building->nama_bangunan ?? '-' }}
                </p>
            </div>

            <div class="glass-surface rounded-3xl p-5">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Nomor RAB</p>
                <p class="mt-2 text-base font-mono font-semibold text-slate-800">
                    {{ $rab->nomor_rab }}
                </p>
            </div>

            <div class="glass-surface rounded-3xl p-5">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal Penyusunan</p>
                <p class="mt-2 text-base font-semibold text-slate-800">
                    {{ \Carbon\Carbon::parse($rab->tanggal_rab)->translatedFormat('d F Y') }}
                </p>
            </div>

            <div class="glass-surface rounded-3xl p-5 bg-emerald-50/50 border-emerald-100">
                <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Total Anggaran Biaya</p>
                <p class="mt-2 text-xl md:text-2xl font-bold text-emerald-700">
                    Rp {{ number_format($rab->total_biaya, 0, ',', '.') }}
                </p>
            </div>

        </div>

        {{-- =========================================
             DETAIL PEKERJAAN TABLE
        ========================================== --}}
        <div class="glass-surface rounded-3xl overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-200/70 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-900">Rincian Item Pekerjaan</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Daftar item AHSP, volume kebutuhan, dan subtotal biaya.</p>
                </div>
            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full text-sm text-left text-slate-700">

                    <thead class="bg-slate-50/80 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-6 py-4 w-16 text-center">No</th>
                            <th class="px-6 py-4">Nama Pekerjaan (AHSP)</th>
                            <th class="px-6 py-4 w-32 text-center">Volume</th>
                            <th class="px-6 py-4 w-44 text-right">Harga Satuan</th>
                            <th class="px-6 py-4 w-48 text-right">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($rab->details as $detail)
                            <tr class="hover:bg-white/60 transition">
                                <td class="px-6 py-4 text-center font-medium text-slate-400">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-slate-900">{{ $detail->ahsp->nama_pekerjaan }}</p>
                                    <p class="text-xs text-slate-400 font-mono mt-0.5">Kode: {{ $detail->ahsp->kode }}</p>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center rounded-lg bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                        {{ $detail->volume }} {{ $detail->ahsp->satuan }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-slate-600 font-mono">
                                    Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-slate-900 font-mono">
                                    Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                    Belum ada rincian pekerjaan pada RAB ini.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                    @if ($rab->details->count())
                        <tfoot class="bg-slate-50/90 border-t border-slate-200/70">
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-right font-bold text-slate-700 uppercase tracking-wider text-xs">
                                    Total Biaya Keseluruhan:
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="text-lg font-bold text-emerald-600 font-mono">
                                        Rp {{ number_format($rab->total_biaya, 0, ',', '.') }}
                                    </span>
                                </td>
                            </tr>
                        </tfoot>
                    @endif

                </table>

            </div>

        </div>

        {{-- =========================================
             FOOTER ACTIONS
        ========================================== --}}
        <div class="flex justify-end">
            <a href="{{ route('rabs.index') }}"
                class="px-5 py-2.5 rounded-2xl border border-slate-200 bg-white text-slate-600 text-xs font-semibold hover:bg-slate-50 transition shadow-sm">
                Kembali ke Daftar RAB
            </a>
        </div>

    </div>

</x-app-layout>
