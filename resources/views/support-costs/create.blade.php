<x-app-layout>

    <x-slot name="header">
        Tambah Biaya Pendukung
    </x-slot>

    <div class="space-y-5">

        {{-- =========================================
             HERO / HEADER CARD
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-cyan-500 via-sky-500 to-blue-600 p-5 md:p-6 text-white shadow-xl">

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
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-white/70 mb-1">
                            Master Data
                        </p>
                        <h1 class="text-xl md:text-2xl font-bold leading-tight">
                            Tambah Data Biaya Pendukung
                        </h1>
                        <p class="text-xs md:text-sm text-white/80 mt-1">
                            Lengkapi data pos biaya tambahan dan operasional pendukung pekerjaan proyek.
                        </p>
                    </div>

                </div>

                <a href="{{ route('support-costs.index') }}"
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

            <form action="{{ route('support-costs.store') }}" method="POST" class="space-y-6 max-w-3xl">

                @csrf

                <!-- Kode & Nama Biaya -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Kode <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="kode" value="{{ old('kode') }}"
                            placeholder="Contoh: BP-001"
                            class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-cyan-400 focus:ring-2 focus:ring-cyan-200/50 outline-none transition"
                            required>
                        @error('kode')
                            <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Nama Biaya <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="nama_biaya" value="{{ old('nama_biaya') }}"
                            placeholder="Contoh: Transportasi Material, Konsumsi Tukang, dll."
                            class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-cyan-400 focus:ring-2 focus:ring-cyan-200/50 outline-none transition"
                            required>
                        @error('nama_biaya')
                            <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Kategori & Harga Satuan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Kategori <span class="text-rose-500">*</span>
                        </label>
                        <select name="kategori"
                            class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-cyan-400 focus:ring-2 focus:ring-cyan-200/50 outline-none transition"
                            required>
                            <option value="Transportasi" {{ old('kategori') == 'Transportasi' ? 'selected' : '' }}>Transportasi</option>
                            <option value="Operasional" {{ old('kategori') == 'Operasional' ? 'selected' : '' }}>Operasional</option>
                            <option value="Lain-lain" {{ old('kategori') == 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                        </select>
                        @error('kategori')
                            <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Harga Satuan <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-sm font-semibold text-slate-400">
                                Rp
                            </span>
                            <input type="number" name="harga_satuan" value="{{ old('harga_satuan') }}"
                                min="0" placeholder="0"
                                class="w-full rounded-2xl border border-slate-200 bg-white/70 pl-11 pr-4 py-3 text-sm text-slate-800 shadow-sm focus:border-cyan-400 focus:ring-2 focus:ring-cyan-200/50 outline-none transition"
                                required>
                        </div>
                        @error('harga_satuan')
                            <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Keterangan -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Keterangan
                    </label>
                    <textarea name="keterangan" rows="3" placeholder="Catatan tambahan pos biaya pendukung (opsional)..."
                        class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-cyan-400 focus:ring-2 focus:ring-cyan-200/50 outline-none transition">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="pt-6 border-t border-slate-200/60 flex items-center justify-end gap-3">

                    <a href="{{ route('support-costs.index') }}"
                        class="px-5 py-2.5 rounded-2xl border border-slate-200 bg-white text-slate-600 text-xs font-semibold hover:bg-slate-50 transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-cyan-600 px-6 py-2.5 text-xs font-semibold text-white shadow-lg shadow-cyan-600/30 hover:bg-cyan-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Biaya
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
