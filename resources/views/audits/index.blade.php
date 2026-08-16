<x-app-layout>

    <x-slot name="header">
        Audit
    </x-slot>

    <div class="space-y-5">

        {{-- =========================================
             HERO
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 p-5 md:p-6 text-white shadow-xl">

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
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>

                    <div class="max-w-2xl">

                        <p class="text-xs md:text-sm font-semibold uppercase tracking-[0.35em] text-white/70 mb-2">
                            Manajemen Audit
                        </p>

                        <h1 class="text-2xl md:text-3xl font-bold leading-tight">
                            Daftar Audit Bangunan
                        </h1>

                        <p class="text-sm md:text-base text-white/80 mt-3 leading-relaxed">
                            Kelola pemeriksaan kondisi bangunan dan hasil klasifikasi KNN untuk
                            menentukan tingkat kelayakan bangunan.
                        </p>

                    </div>

                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 lg:justify-end lg:self-start">

                    <a href="{{ route('audits.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white text-amber-600 px-4 py-2.5 text-sm font-semibold shadow-lg hover:bg-slate-100 transition whitespace-nowrap">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>

                        Audit Baru

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
                    <h2 class="text-lg font-semibold text-slate-900">Data Audit</h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Total {{ $audits->total() }} audit tersedia dalam sistem.
                    </p>
                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full text-sm text-left text-slate-700">

                    <thead class="bg-slate-50/80 text-xs font-semibold uppercase tracking-wide text-slate-500">

                        <tr>
                            <th class="px-6 py-4">Nomor Audit</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Bangunan</th>
                            <th class="px-6 py-4">Konstruksi</th>
                            <th class="px-6 py-4">Hasil KNN</th>
                            <th class="px-6 py-4 w-32 text-center">Aksi</th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($audits as $audit)
                            <tr class="hover:bg-white/60 transition">

                                <td class="px-6 py-4">
                                    <span class="font-mono font-semibold text-slate-700 text-xs">
                                        {{ $audit->nomor_audit }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ \Carbon\Carbon::parse($audit->tanggal_audit)->translatedFormat('d M Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    <p class="font-semibold text-slate-900">{{ $audit->building->nama_bangunan ?? '-' }}</p>
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                        {{ $audit->building->jenis_konstruksi ?? '-' }}
                                    </span>
                                </td>

                                {{-- HASIL KNN --}}
                                <td class="px-6 py-4">

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

                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $style }}">
                                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                            {{ $audit->hasil_knn }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">
                                            Belum Diproses
                                        </span>
                                    @endif

                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-center">

                                        <a href="{{ route('audits.show', $audit) }}"
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

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="px-6 py-16 text-center">

                                    <div class="flex flex-col items-center justify-center gap-3 text-slate-400">

                                        <div
                                            class="w-16 h-16 rounded-3xl bg-slate-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                        </div>

                                        <div>
                                            <p class="font-medium text-slate-500">Belum ada data audit</p>
                                            <p class="text-sm text-slate-400 mt-1">Tambahkan audit baru untuk mulai memeriksa bangunan.</p>
                                        </div>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            @if ($audits->hasPages())
                <div class="border-t border-slate-200/70 px-5 py-4">
                    {{ $audits->links() }}
                </div>
            @endif

        </div>

    </div>

</x-app-layout>
