<x-app-layout>

    <x-slot name="header">
        Edit Equipment
    </x-slot>

    <div class="space-y-5">

        {{-- =========================================
             HERO / HEADER CARD
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-slate-600 via-slate-700 to-gray-800 p-5 md:p-6 text-white shadow-xl">

            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.12),transparent_45%)]">
            </div>

            <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div class="flex items-start gap-4">

                    <div
                        class="w-14 h-14 rounded-2xl bg-white/15 border border-white/20 backdrop-blur-sm flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-semibold uppercase tracking-[0.35em] text-white/70">
                                Master Data
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full bg-white/20 text-white text-[10px] font-bold font-mono">
                                {{ $equipment->kode }}
                            </span>
                        </div>
                        <h1 class="text-xl md:text-2xl font-bold leading-tight">
                            Edit: {{ $equipment->nama_alat }}
                        </h1>
                        <p class="text-xs md:text-sm text-white/80 mt-1">
                            Perbarui data peralatan, satuan pemakaian, dan harga sewa.
                        </p>
                    </div>

                </div>

                <a href="{{ route('equipments.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white/20 hover:bg-white/30 text-white px-4 py-2.5 text-xs font-semibold backdrop-blur-sm border border-white/20 transition whitespace-nowrap self-start sm:self-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>

            </div>

        </div>

        {{-- =========================================
             ALERT VALIDATION
        ========================================== --}}
        @if ($errors->any())
            <div class="rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700 shadow-sm">
                <div class="flex items-center gap-2 font-semibold mb-2">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Terdapat beberapa kesalahan input:
                </div>
                <ul class="list-disc pl-5 space-y-1 text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- =========================================
             FORM CARD
        ========================================== --}}
        <div class="glass-surface rounded-3xl overflow-hidden p-6 md:p-8">

            <form action="{{ route('equipments.update', $equipment->id) }}" method="POST" class="space-y-6 max-w-3xl">

                @csrf
                @method('PUT')

                <!-- Nama Alat -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Nama Alat / Equipment <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="nama_alat" value="{{ old('nama_alat', $equipment->nama_alat) }}"
                        placeholder="Contoh: Ekskavator Mini, Stamper Kuda, Molen Cor, dll."
                        class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200/50 outline-none transition"
                        required>
                    @error('nama_alat')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Satuan -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Satuan <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="satuan" value="{{ old('satuan', $equipment->satuan) }}"
                            placeholder="Contoh: Jam, Hari, Unit, Set"
                            class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200/50 outline-none transition"
                            required>
                        @error('satuan')
                            <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Harga Satuan -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Harga Satuan (Sewa/Beli) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-sm font-semibold text-slate-400">
                                Rp
                            </span>
                            <input type="number" name="harga_satuan"
                                value="{{ old('harga_satuan', $equipment->harga_satuan) }}" min="0" placeholder="0"
                                class="w-full rounded-2xl border border-slate-200 bg-white/70 pl-11 pr-4 py-3 text-sm text-slate-800 shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200/50 outline-none transition"
                                required>
                        </div>
                        @error('harga_satuan')
                            <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="pt-6 border-t border-slate-200/60 flex items-center justify-end gap-3">

                    <a href="{{ route('equipments.index') }}"
                        class="px-5 py-2.5 rounded-2xl border border-slate-200 bg-white text-slate-600 text-xs font-semibold hover:bg-slate-50 transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-800 px-6 py-2.5 text-xs font-semibold text-white shadow-lg shadow-slate-900/30 hover:bg-slate-900 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Equipment
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
