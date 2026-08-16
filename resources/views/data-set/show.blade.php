<x-app-layout>

    <x-slot name="header">
        Detail Dataset KNN
    </x-slot>

    <div class="space-y-5">

        {{-- =========================================
             HERO / HEADER CARD
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-violet-500 via-purple-500 to-indigo-600 p-5 md:p-6 text-white shadow-xl">

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
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-semibold uppercase tracking-[0.35em] text-white/70">
                                Machine Learning
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full bg-white/20 text-white text-[10px] font-bold font-mono">
                                {{ $dataSet->kode_data }}
                            </span>
                        </div>
                        <h1 class="text-xl md:text-2xl font-bold leading-tight">
                            {{ $dataSet->nama_bangunan }}
                        </h1>
                        <p class="text-xs md:text-sm text-white/80 mt-1">
                            Detail profil sampel data latih, skor 10 komponen, dan label kategori klasifikasi K-NN.
                        </p>
                    </div>

                </div>

                <div class="flex items-center gap-2 self-start sm:self-center">
                    <a href="{{ route('data-set.edit', $dataSet->id) }}"
                        class="inline-flex items-center justify-center gap-1.5 rounded-2xl bg-white text-violet-600 px-4 py-2.5 text-xs font-semibold shadow-md hover:bg-slate-50 transition whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Data
                    </a>
                    <a href="{{ route('data-set.index') }}"
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
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kode Data</p>
                <p class="mt-2 text-base font-mono font-bold text-slate-800">{{ $dataSet->kode_data }}</p>
            </div>

            <div class="glass-surface rounded-3xl p-5">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Nama Bangunan</p>
                <p class="mt-2 text-base font-semibold text-slate-900">{{ $dataSet->nama_bangunan }}</p>
            </div>

            <div class="glass-surface rounded-3xl p-5">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jenis Konstruksi</p>
                <p class="mt-2 text-base font-semibold text-slate-800">{{ $dataSet->jenis_konstruksi }}</p>
            </div>

            <div class="glass-surface rounded-3xl p-5">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kategori Kelayakan</p>
                <div class="mt-2">
                    @php
                        $warnaBadge = match ($dataSet->kategori) {
                            'Layak' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                            'Kurang Layak' => 'bg-amber-50 text-amber-700 border-amber-200',
                            'Tidak Layak' => 'bg-rose-50 text-rose-700 border-rose-200',
                            default => 'bg-slate-50 text-slate-700 border-slate-200',
                        };
                    @endphp
                    <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full border {{ $warnaBadge }}">
                        {{ $dataSet->kategori }}
                    </span>
                </div>
            </div>

        </div>

        {{-- =========================================
             TABLE KOMPONEN BANGUNAN
        ========================================== --}}
        <div class="glass-surface rounded-3xl overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-200/70 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-900">Nilai Kondisi 10 Komponen</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Nilai parameter atribut skala 1 (Rusak Berat) hingga 5 (Sangat Baik).</p>
                </div>
            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full text-sm text-left text-slate-700">

                    <thead class="bg-slate-50/80 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-6 py-4 w-16 text-center">No</th>
                            <th class="px-6 py-4">Komponen Bangunan</th>
                            <th class="px-6 py-4 w-40 text-center">Nilai Atribut</th>
                            <th class="px-6 py-4">Keterangan Skala</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @php
                            $komponen = [
                                'pondasi' => 'Pondasi',
                                'struktur' => 'Struktur Kolom & Balok',
                                'atap' => 'Atap & Rangka',
                                'dinding' => 'Dinding & Partisi',
                                'lantai' => 'Lantai / Keramik',
                                'plafon' => 'Plafon',
                                'pintu' => 'Pintu & Kusen',
                                'jendela' => 'Jendela & Kaca',
                                'listrik' => 'Instalasi Elektrikal',
                                'sanitasi' => 'Sanitasi & Plumbing',
                            ];
                        @endphp

                        @foreach ($komponen as $field => $label)
                            @php
                                $val = $dataSet->$field;
                                $skalaDesc = match ($val) {
                                    5 => 'Sangat Baik (Kondisi Prima)',
                                    4 => 'Baik (Kondisi Normal)',
                                    3 => 'Rusak Ringan (Perlu Pemeliharaan)',
                                    2 => 'Rusak Sedang (Perlu Perbaikan Parsial)',
                                    1 => 'Rusak Berat (Perlu Penggantian Total)',
                                    default => '-',
                                };
                            @endphp
                            <tr class="hover:bg-white/60 transition">
                                <td class="px-6 py-3.5 text-center font-medium text-slate-400">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-3.5 font-semibold text-slate-900">
                                    {{ $label }}
                                </td>
                                <td class="px-6 py-3.5 text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-violet-50 text-violet-700 font-bold text-xs border border-violet-100">
                                        {{ $val }}
                                    </span>
                                </td>
                                <td class="px-6 py-3.5 text-xs text-slate-600">
                                    {{ $skalaDesc }}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

        {{-- =========================================
             KETERANGAN TAMBAHAN
        ========================================== --}}
        @if ($dataSet->keterangan)
            <div class="glass-surface rounded-3xl p-5">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Catatan Tambahan</p>
                <p class="mt-2 text-sm text-slate-700 leading-relaxed">{{ $dataSet->keterangan }}</p>
            </div>
        @endif

        {{-- =========================================
             FOOTER ACTIONS
        ========================================== --}}
        <div class="flex justify-end">
            <a href="{{ route('data-set.index') }}"
                class="px-5 py-2.5 rounded-2xl border border-slate-200 bg-white text-slate-600 text-xs font-semibold hover:bg-slate-50 transition shadow-sm">
                Kembali ke Daftar Data Latih
            </a>
        </div>

    </div>

</x-app-layout>
