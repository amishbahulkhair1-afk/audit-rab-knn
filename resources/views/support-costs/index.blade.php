<x-app-layout>

    <x-slot name="header">
        Biaya Pendukung
    </x-slot>

    <div class="space-y-5">

        {{-- =========================================
             HERO
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-cyan-500 via-sky-500 to-blue-600 p-5 md:p-6 text-white shadow-xl">

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
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <div class="max-w-2xl">

                        <p class="text-xs md:text-sm font-semibold uppercase tracking-[0.35em] text-white/70 mb-2">
                            Master Data
                        </p>

                        <h1 class="text-2xl md:text-3xl font-bold leading-tight">
                            Daftar Biaya Pendukung
                        </h1>

                        <p class="text-sm md:text-base text-white/80 mt-3 leading-relaxed">
                            Kelola seluruh biaya tambahan dan kebutuhan pendukung konstruksi yang
                            digunakan dalam penyusunan Rencana Anggaran Biaya.
                        </p>

                    </div>

                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 lg:justify-end lg:self-start">

                    <a href="{{ route('support-costs.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white text-cyan-600 px-4 py-2.5 text-sm font-semibold shadow-lg hover:bg-slate-100 transition whitespace-nowrap">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>

                        Tambah Biaya

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
                        Unggah file Excel untuk menambahkan data biaya pendukung secara massal.
                    </p>
                </div>

                <form action="{{ route('support-costs.import') }}" method="POST" enctype="multipart/form-data"
                    class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">

                    @csrf

                    <input type="file" name="excel"
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

                <p class="font-semibold mb-2">Data gagal diimport:</p>

                <ul class="list-disc pl-5 space-y-1">
                    @foreach (session('import_errors') as $error)
                        <li>Baris {{ $error['baris'] }} : {{ $error['pesan'] }}</li>
                    @endforeach
                </ul>

            </div>
        @endif


        {{-- =========================================
             TABLE
        ========================================== --}}
        <div class="glass-surface rounded-3xl overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-200/70 flex items-center justify-between">

                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Data Biaya Pendukung</h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Total {{ $supportCosts->total() }} item biaya pendukung dalam sistem.
                    </p>
                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full text-sm text-left text-slate-700">

                    <thead class="bg-slate-50/80 text-xs font-semibold uppercase tracking-wide text-slate-500">

                        <tr>
                            <th class="px-6 py-4 w-32">Kode</th>
                            <th class="px-6 py-4">Nama Biaya</th>
                            <th class="px-6 py-4 w-40">Kategori</th>
                            <th class="px-6 py-4 w-48">Harga Satuan</th>
                            <th class="px-6 py-4 w-48 text-center">Aksi</th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($supportCosts as $item)
                            <tr class="hover:bg-white/60 transition">

                                <td class="px-6 py-4">
                                    <span class="font-mono font-semibold text-slate-700 text-xs">
                                        {{ $item->kode }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <p class="font-semibold text-slate-900">{{ $item->nama_biaya }}</p>
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                        {{ $item->kategori }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-slate-900">
                                        Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-center gap-2">

                                        <a href="{{ route('support-costs.show', $item) }}"
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

                                        <a href="{{ route('support-costs.edit', $item) }}"
                                            class="inline-flex items-center gap-1.5 rounded-xl border border-amber-200 bg-amber-50 px-3 py-2 text-xs font-medium text-amber-700 hover:bg-amber-100 transition">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>

                                            Edit

                                        </a>

                                        <form action="{{ route('support-costs.destroy', $item) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Hapus data biaya ini?')">
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
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>

                                        <div>
                                            <p class="font-medium text-slate-500">Belum ada data biaya pendukung</p>
                                            <p class="text-sm text-slate-400 mt-1">Tambahkan biaya baru atau import dari Excel.</p>
                                        </div>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            @if ($supportCosts->hasPages())
                <div class="border-t border-slate-200/70 px-5 py-4">
                    {{ $supportCosts->links() }}
                </div>
            @endif

        </div>

    </div>

</x-app-layout>
