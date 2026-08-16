<x-app-layout>

    <x-slot name="header">
        Equipment
    </x-slot>

    <div class="space-y-5">

        {{-- =========================================
             HERO
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-slate-600 via-slate-700 to-gray-800 p-5 md:p-6 text-white shadow-xl">

            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.12),transparent_45%)]">
            </div>

            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                <div class="flex items-start gap-4">

                    <div
                        class="w-16 h-16 rounded-2xl bg-white/15 border border-white/20 backdrop-blur-sm flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>

                    <div class="max-w-2xl">

                        <p class="text-xs md:text-sm font-semibold uppercase tracking-[0.35em] text-white/70 mb-2">
                            Master Data
                        </p>

                        <h1 class="text-2xl md:text-3xl font-bold leading-tight">
                            Daftar Data Equipment
                        </h1>

                        <p class="text-sm md:text-base text-white/80 mt-3 leading-relaxed">
                            Kelola seluruh data peralatan dan alat kerja konstruksi beserta
                            harga sewa yang digunakan pada penyusunan AHSP dan RAB.
                        </p>

                    </div>

                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 lg:justify-end lg:self-start">

                    <a href="{{ route('equipments.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white text-slate-700 px-4 py-2.5 text-sm font-semibold shadow-lg hover:bg-slate-100 transition whitespace-nowrap">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>

                        Tambah Equipment

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
                        Unggah file Excel untuk menambahkan data equipment secara massal.
                    </p>
                </div>

                <form action="{{ route('equipments.import') }}" method="POST" enctype="multipart/form-data"
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
                    <h2 class="text-lg font-semibold text-slate-900">Data Equipment</h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Total {{ $equipments->total() }} equipment tersedia dalam sistem.
                    </p>
                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full text-sm text-left text-slate-700">

                    <thead class="bg-slate-50/80 text-xs font-semibold uppercase tracking-wide text-slate-500">

                        <tr>
                            <th class="px-6 py-4 w-32">Kode</th>
                            <th class="px-6 py-4">Nama Alat</th>
                            <th class="px-6 py-4 w-32">Satuan</th>
                            <th class="px-6 py-4 w-48">Harga Satuan</th>
                            <th class="px-6 py-4 w-48 text-center">Aksi</th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($equipments as $equipment)
                            <tr class="hover:bg-white/60 transition">

                                <td class="px-6 py-4">
                                    <span class="font-mono font-semibold text-slate-600 text-xs">
                                        {{ $equipment->kode }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <p class="font-semibold text-slate-900">{{ $equipment->nama_alat }}</p>
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700 border border-slate-200">
                                        {{ $equipment->satuan }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-slate-900">
                                        Rp {{ number_format($equipment->harga_satuan, 0, ',', '.') }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-center gap-2">

                                        <a href="{{ route('equipments.show', $equipment->id) }}"
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

                                        <a href="{{ route('equipments.edit', $equipment->id) }}"
                                            class="inline-flex items-center gap-1.5 rounded-xl border border-amber-200 bg-amber-50 px-3 py-2 text-xs font-medium text-amber-700 hover:bg-amber-100 transition">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>

                                            Edit

                                        </a>

                                        <form action="{{ route('equipments.destroy', $equipment->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Hapus data equipment ini?')">
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
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                        </div>

                                        <div>
                                            <p class="font-medium text-slate-500">Belum ada data equipment</p>
                                            <p class="text-sm text-slate-400 mt-1">Tambahkan equipment baru atau import dari Excel.</p>
                                        </div>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            @if ($equipments->hasPages())
                <div class="border-t border-slate-200/70 px-5 py-4">
                    {{ $equipments->links() }}
                </div>
            @endif

        </div>

    </div>

</x-app-layout>
