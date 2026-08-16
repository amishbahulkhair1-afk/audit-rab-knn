<x-app-layout>

    <x-slot name="header">
        AHSP
    </x-slot>

    <div class="space-y-5">

        {{-- =========================================
             HERO
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 p-5 md:p-6 text-white shadow-xl">

            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.18),transparent_45%)]">
            </div>

            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                <div class="flex items-start gap-4">

                    <div
                        class="w-16 h-16 rounded-2xl bg-white/15 border border-white/20 backdrop-blur-sm flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>

                    <div class="max-w-2xl">

                        <p class="text-xs md:text-sm font-semibold uppercase tracking-[0.35em] text-white/70 mb-2">
                            Master Data
                        </p>

                        <h1 class="text-2xl md:text-3xl font-bold leading-tight">
                            Analisis Harga Satuan Pekerjaan
                        </h1>

                        <p class="text-sm md:text-base text-white/80 mt-3 leading-relaxed">
                            Kelola standar analisis pekerjaan konstruksi beserta komponen biaya yang
                            digunakan pada penyusunan RAB.
                        </p>

                    </div>

                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 lg:justify-end lg:self-start">

                    <a href="{{ route('ahsps.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white text-emerald-600 px-4 py-2.5 text-sm font-semibold shadow-lg hover:bg-slate-100 transition whitespace-nowrap">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>

                        Tambah AHSP

                    </a>

                </div>

            </div>

        </div>


        {{-- =========================================
             ALERT
        ========================================== --}}
        @if (session('success'))
            <div
                class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 shadow-sm">
                {{ session('success') }}
            </div>
        @endif


        {{-- =========================================
             TABLE
        ========================================== --}}
        <div class="glass-surface rounded-3xl overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-200/70 flex items-center justify-between">

                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Data AHSP</h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Total {{ $ahsps->total() }} data analisis tersedia dalam sistem.
                    </p>
                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full text-sm text-left text-slate-700">

                    <thead class="bg-slate-50/80 text-xs font-semibold uppercase tracking-wide text-slate-500">

                        <tr>
                            <th class="px-6 py-4 w-36">Kode</th>
                            <th class="px-6 py-4">Nama Pekerjaan</th>
                            <th class="px-6 py-4 w-32">Satuan</th>
                            <th class="px-6 py-4 w-48 text-center">Aksi</th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($ahsps as $ahsp)
                            <tr class="hover:bg-white/60 transition">

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center rounded-lg bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700 border border-emerald-100 font-mono">
                                        {{ $ahsp->kode }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <p class="font-semibold text-slate-900">{{ $ahsp->nama_pekerjaan }}</p>
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 border border-blue-100">
                                        {{ $ahsp->satuan }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-center gap-2">

                                        <a href="{{ route('ahsps.show', $ahsp) }}"
                                            class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-medium text-slate-600 hover:border-indigo-200 hover:text-indigo-600 hover:bg-indigo-50 transition">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7S3.732 16.057 2.458 12z" />
                                            </svg>

                                            Detail

                                        </a>

                                        <a href="{{ route('ahsps.edit', $ahsp) }}"
                                            class="inline-flex items-center gap-1.5 rounded-xl border border-amber-200 bg-amber-50 px-3 py-2 text-xs font-medium text-amber-700 hover:bg-amber-100 transition">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>

                                            Edit

                                        </a>

                                        <form action="{{ route('ahsps.destroy', $ahsp) }}" method="POST"
                                            onsubmit="return confirm('Hapus data AHSP ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs font-medium text-red-600 hover:bg-red-100 transition">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />
                                                </svg>

                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="px-6 py-16 text-center">

                                    <div class="flex flex-col items-center justify-center gap-3 text-slate-400">

                                        <div
                                            class="w-16 h-16 rounded-3xl bg-slate-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>

                                        <div>
                                            <p class="font-medium text-slate-500">Belum ada data AHSP</p>
                                            <p class="text-sm text-slate-400 mt-1">Tambahkan AHSP baru untuk mulai mengelola data.</p>
                                        </div>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            @if ($ahsps->hasPages())
                <div class="border-t border-slate-200/70 px-5 py-4">
                    {{ $ahsps->links() }}
                </div>
            @endif

        </div>

    </div>

</x-app-layout>
