<x-app-layout>

    <x-slot name="header">
        Dataset KNN
    </x-slot>

    <div class="space-y-5">

        {{-- =========================================
             HERO
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-violet-500 via-purple-500 to-indigo-600 p-5 md:p-6 text-white shadow-xl">

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
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>

                    <div class="max-w-2xl">

                        <p class="text-xs md:text-sm font-semibold uppercase tracking-[0.35em] text-white/70 mb-2">
                            Machine Learning
                        </p>

                        <h1 class="text-2xl md:text-3xl font-bold leading-tight">
                            Data Latih KNN
                        </h1>

                        <p class="text-sm md:text-base text-white/80 mt-3 leading-relaxed">
                            Kelola dataset pelatihan untuk algoritma K-Nearest Neighbor yang digunakan
                            dalam klasifikasi tingkat kelayakan bangunan.
                        </p>

                    </div>

                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 lg:justify-end lg:self-start">

                    <a href="{{ route('data-set.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white text-violet-600 px-4 py-2.5 text-sm font-semibold shadow-lg hover:bg-slate-100 transition whitespace-nowrap">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>

                        Tambah Data Latih

                    </a>

                </div>

            </div>

        </div>


        {{-- =========================================
             IMPORT
        ========================================== --}}
        <div class="glass-surface rounded-3xl p-4 md:p-5">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                <div>
                    <h2 class="text-base md:text-lg font-semibold text-slate-900">
                        Import Excel
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Unggah file Excel untuk menambahkan data latih KNN secara massal.
                    </p>
                </div>

                <form action="{{ route('data-set.import') }}" method="POST" enctype="multipart/form-data"
                    class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">

                    @csrf

                    <input type="file" name="excel" accept=".xlsx,.xls,.csv"
                        class="w-full sm:w-72 rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-600 shadow-sm focus:border-indigo-300 focus:ring-2 focus:ring-indigo-200/50 outline-none"
                        required>

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-2xl bg-indigo-600 text-white text-sm font-semibold shadow-lg hover:bg-indigo-700 transition whitespace-nowrap">
                        Import Excel
                    </button>

                </form>

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

        @if (session('import_errors') && count(session('import_errors')) > 0)
            <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-4 text-sm text-red-700 shadow-sm">

                <p class="font-semibold mb-2">Beberapa data gagal diimport:</p>

                <div class="space-y-1">
                    @foreach (session('import_errors') as $error)
                        <div>
                            <strong>Baris {{ $error['baris'] }}</strong> : {{ $error['pesan'] }}
                        </div>
                    @endforeach
                </div>

            </div>
        @endif


        {{-- =========================================
             TABLE
        ========================================== --}}
        <div class="glass-surface rounded-3xl overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-200/70 flex items-center justify-between">

                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Data Latih KNN</h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Total {{ $dataSet->total() }} data latih tersedia dalam sistem.
                    </p>
                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full text-sm text-left text-slate-700">

                    <thead class="bg-slate-50/80 text-xs font-semibold uppercase tracking-wide text-slate-500">

                        <tr>
                            <th class="px-6 py-4 w-32">Kode</th>
                            <th class="px-6 py-4">Nama Bangunan</th>
                            <th class="px-6 py-4">Jenis Konstruksi</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4 w-48 text-center">Aksi</th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($dataSet as $data)
                            <tr class="hover:bg-white/60 transition">

                                <td class="px-6 py-4">
                                    <span class="font-mono font-semibold text-slate-600 text-xs">
                                        {{ $data->kode_data }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <p class="font-semibold text-slate-900">{{ $data->nama_bangunan }}</p>
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $data->jenis_konstruksi }}
                                </td>

                                <td class="px-6 py-4">
                                    @php
                                        $warnaBadge = match ($data->kategori) {
                                            'Layak' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                            'Kurang Layak' => 'bg-amber-50 text-amber-700 border-amber-200',
                                            'Tidak Layak' => 'bg-rose-50 text-rose-700 border-rose-200',
                                            default => 'bg-slate-50 text-slate-700 border-slate-200',
                                        };
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full border {{ $warnaBadge }}">
                                        {{ $data->kategori }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-center gap-2">

                                        <a href="{{ route('data-set.show', $data->id) }}"
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

                                        <a href="{{ route('data-set.edit', $data->id) }}"
                                            class="inline-flex items-center gap-1.5 rounded-xl border border-amber-200 bg-amber-50 px-3 py-2 text-xs font-medium text-amber-700 hover:bg-amber-100 transition">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>

                                            Edit

                                        </a>

                                        <form action="{{ route('data-set.destroy', $data->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Hapus data latih ini?')">
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

                                <td colspan="5" class="px-6 py-16 text-center">

                                    <div class="flex flex-col items-center justify-center gap-3 text-slate-400">

                                        <div
                                            class="w-16 h-16 rounded-3xl bg-slate-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                            </svg>
                                        </div>

                                        <div>
                                            <p class="font-medium text-slate-500">Belum ada data latih</p>
                                            <p class="text-sm text-slate-400 mt-1">Tambahkan data latih baru atau import dari Excel.</p>
                                        </div>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            @if ($dataSet->hasPages())
                <div class="border-t border-slate-200/70 px-5 py-4">
                    {{ $dataSet->links() }}
                </div>
            @endif

        </div>

    </div>

</x-app-layout>
