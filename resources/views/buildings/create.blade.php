<x-app-layout>

    <x-slot name="header">
        Tambah Bangunan
    </x-slot>

    <div class="space-y-5">

        {{-- =========================================
             HERO / HEADER CARD
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-blue-500 via-indigo-500 to-violet-500 p-5 md:p-6 text-white shadow-xl">

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
                                d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M12 4v4m-2-2h4" />
                        </svg>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-white/70 mb-1">
                            Master Data
                        </p>
                        <h1 class="text-xl md:text-2xl font-bold leading-tight">
                            Tambah Data Bangunan
                        </h1>
                        <p class="text-xs md:text-sm text-white/80 mt-1">
                            Masukkan informasi fasilitas bangunan baru untuk proses audit dan penyusunan RAB.
                        </p>
                    </div>

                </div>

                <a href="{{ route('buildings.index') }}"
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

            <form action="{{ route('buildings.store') }}" method="POST" class="space-y-6">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Kode Bangunan --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Kode Bangunan <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="kode_bangunan" value="{{ old('kode_bangunan') }}"
                            placeholder="Contoh: BGN-001"
                            class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200/50 outline-none transition"
                            required>
                        @error('kode_bangunan')
                            <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nama Bangunan --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Nama Bangunan <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="nama_bangunan" value="{{ old('nama_bangunan') }}"
                            placeholder="Contoh: Gedung Madrasah Aliyah"
                            class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200/50 outline-none transition"
                            required>
                        @error('nama_bangunan')
                            <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jenis Bangunan --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Jenis Bangunan <span class="text-rose-500">*</span>
                        </label>
                        <select name="jenis_bangunan"
                            class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200/50 outline-none transition"
                            required>
                            <option value="">-- Pilih Jenis Bangunan --</option>
                            @foreach (['Masjid', 'Madrasah', 'Asrama', 'Gedung Serbaguna', 'Kantor'] as $jenis)
                                <option value="{{ $jenis }}" {{ old('jenis_bangunan') == $jenis ? 'selected' : '' }}>
                                    {{ $jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_bangunan')
                            <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jenis Konstruksi --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Jenis Konstruksi <span class="text-rose-500">*</span>
                        </label>
                        <select name="jenis_konstruksi"
                            class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200/50 outline-none transition"
                            required>
                            <option value="">-- Pilih Konstruksi --</option>
                            @foreach (['Gedek', 'Semi Permanen', 'Permanen', 'Permanen Bertingkat'] as $konstruksi)
                                <option value="{{ $konstruksi }}"
                                    {{ old('jenis_konstruksi') == $konstruksi ? 'selected' : '' }}>
                                    {{ $konstruksi }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_konstruksi')
                            <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Rayon --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Rayon / Wilayah <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="rayon" value="{{ old('rayon') }}"
                            placeholder="Contoh: Rayon Timur, Rayon Pusat"
                            class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200/50 outline-none transition"
                            required>
                        @error('rayon')
                            <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tahun Berdiri --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Tahun Berdiri
                        </label>
                        <input type="number" name="tahun_berdiri" value="{{ old('tahun_berdiri') }}"
                            placeholder="Contoh: 2018" min="1900" max="{{ date('Y') + 1 }}"
                            class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200/50 outline-none transition">
                        @error('tahun_berdiri')
                            <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Luas Bangunan --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Luas Bangunan (m²)
                        </label>
                        <input type="number" step="0.01" name="luas_bangunan" value="{{ old('luas_bangunan') }}"
                            placeholder="Contoh: 450.5"
                            class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200/50 outline-none transition">
                        @error('luas_bangunan')
                            <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Alamat Lengkap
                        </label>
                        <textarea name="alamat" rows="3" placeholder="Masukkan alamat lokasi bangunan..."
                            class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200/50 outline-none transition">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="pt-6 border-t border-slate-200/60 flex items-center justify-end gap-3">

                    <a href="{{ route('buildings.index') }}"
                        class="px-5 py-2.5 rounded-2xl border border-slate-200 bg-white text-slate-600 text-xs font-semibold hover:bg-slate-50 transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-blue-600 px-6 py-2.5 text-xs font-semibold text-white shadow-lg shadow-blue-600/30 hover:bg-blue-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Bangunan
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
