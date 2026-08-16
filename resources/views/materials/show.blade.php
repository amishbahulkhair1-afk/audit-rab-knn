<x-app-layout>

    <x-slot name="header">
        Detail Material
    </x-slot>

    <div class="space-y-5">

        {{-- =========================================
             HERO / HEADER CARD
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-indigo-500 via-blue-500 to-violet-500 p-5 md:p-6 text-white shadow-xl">

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
                                d="M20 7l-8-4-8 4m16 0v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7m16 0l-8 4m-8-4l8 4" />
                        </svg>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-semibold uppercase tracking-[0.35em] text-white/70">
                                Master Data
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full bg-white/20 text-white text-[10px] font-bold">
                                #{{ $material->id }}
                            </span>
                        </div>
                        <h1 class="text-xl md:text-2xl font-bold leading-tight">
                            {{ $material->nama_bahan }}
                        </h1>
                        <p class="text-xs md:text-sm text-white/80 mt-1">
                            Detail rincian bahan material pendukung penyusunan AHSP dan RAB.
                        </p>
                    </div>

                </div>

                <div class="flex items-center gap-2 self-start sm:self-center">
                    <a href="{{ route('materials.edit', $material->id) }}"
                        class="inline-flex items-center justify-center gap-1.5 rounded-2xl bg-white text-indigo-600 px-4 py-2.5 text-xs font-semibold shadow-md hover:bg-slate-50 transition whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Data
                    </a>
                    <a href="{{ route('materials.index') }}"
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

                <!-- ID -->
                <div class="p-5 rounded-2xl bg-white/60 border border-slate-200/70">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                        ID Material
                    </p>
                    <p class="mt-2 text-base font-semibold text-slate-800">
                        #{{ $material->id }}
                    </p>
                </div>

                <!-- Nama Bahan -->
                <div class="p-5 rounded-2xl bg-white/60 border border-slate-200/70">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Nama Bahan
                    </p>
                    <p class="mt-2 text-base font-semibold text-slate-900">
                        {{ $material->nama_bahan }}
                    </p>
                </div>

                <!-- Satuan -->
                <div class="p-5 rounded-2xl bg-white/60 border border-slate-200/70">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Satuan
                    </p>
                    <span
                        class="inline-flex mt-2 px-3 py-1 text-xs font-semibold rounded-lg bg-blue-50 text-blue-700 border border-blue-100">
                        {{ $material->satuan }}
                    </span>
                </div>

                <!-- Harga Satuan -->
                <div class="p-5 rounded-2xl bg-indigo-50/60 border border-indigo-100">
                    <p class="text-xs font-bold text-indigo-400 uppercase tracking-wider">
                        Harga Satuan
                    </p>
                    <p class="mt-2 text-xl font-bold text-indigo-700">
                        Rp {{ number_format($material->harga_satuan, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Keterangan -->
                <div class="md:col-span-2 p-5 rounded-2xl bg-white/60 border border-slate-200/70">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Keterangan
                    </p>
                    <p class="mt-2 text-sm text-slate-700 leading-relaxed">
                        {{ $material->keterangan ?? 'Tidak ada keterangan tambahan.' }}
                    </p>
                </div>

            </div>

            <!-- Action Delete Form -->
            <div class="mt-8 pt-6 border-t border-slate-200/60 flex items-center justify-between">
                <a href="{{ route('materials.index') }}"
                    class="px-5 py-2.5 rounded-2xl border border-slate-200 bg-white text-slate-600 text-xs font-semibold hover:bg-slate-50 transition">
                    Kembali ke Daftar
                </a>

                <form action="{{ route('materials.destroy', $material->id) }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus material ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-2xl border border-red-200 bg-red-50 text-red-600 text-xs font-semibold hover:bg-red-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />
                        </svg>
                        Hapus Material
                    </button>
                </form>
            </div>

        </div>

    </div>

</x-app-layout>
