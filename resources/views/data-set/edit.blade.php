<x-app-layout>

    <x-slot name="header">
        Edit Dataset KNN
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
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
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
                            Edit: {{ $dataSet->nama_bangunan }}
                        </h1>
                        <p class="text-xs md:text-sm text-white/80 mt-1">
                            Perbarui nilai penilaian komponen sampel dan label kategori kelayakan.
                        </p>
                    </div>

                </div>

                <a href="{{ route('data-set.index') }}"
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

            <form action="{{ route('data-set.update', $dataSet->id) }}" method="POST" class="space-y-8">

                @csrf
                @method('PUT')

                <!-- Informasi Dasar Data Latih -->
                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-violet-500"></span>
                        Informasi Dasar Bangunan
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Nama Bangunan --}}
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                Nama Bangunan <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="nama_bangunan"
                                value="{{ old('nama_bangunan', $dataSet->nama_bangunan) }}"
                                placeholder="Contoh: Gedung Aula Pertemuan"
                                class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-200/50 outline-none transition"
                                required>
                            @error('nama_bangunan')
                                <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jenis Konstruksi --}}
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                Jenis Konstruksi <span class="text-rose-500">*</span>
                            </label>
                            <select name="jenis_konstruksi"
                                class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-200/50 outline-none transition"
                                required>
                                @foreach (['Gedek', 'Semi Permanen', 'Permanen', 'Permanen Bertingkat'] as $jenis)
                                    <option value="{{ $jenis }}"
                                        {{ old('jenis_konstruksi', $dataSet->jenis_konstruksi) == $jenis ? 'selected' : '' }}>
                                        {{ $jenis }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_konstruksi')
                                <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Skala Penilaian Banner -->
                <div class="rounded-2xl bg-violet-500/10 border border-violet-500/20 p-4">
                    <p class="text-xs font-bold uppercase tracking-wider text-violet-800 mb-2">
                        Skala Penilaian Kondisi (1 - 5):
                    </p>
                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-2 text-xs font-medium text-violet-900">
                        <div class="bg-white/80 rounded-xl px-3 py-1.5 border border-violet-200/50 text-center">5 = Sangat Baik</div>
                        <div class="bg-white/80 rounded-xl px-3 py-1.5 border border-violet-200/50 text-center">4 = Baik</div>
                        <div class="bg-white/80 rounded-xl px-3 py-1.5 border border-violet-200/50 text-center">3 = Rusak Ringan</div>
                        <div class="bg-white/80 rounded-xl px-3 py-1.5 border border-violet-200/50 text-center">2 = Rusak Sedang</div>
                        <div class="bg-white/80 rounded-xl px-3 py-1.5 border border-violet-200/50 text-center">1 = Rusak Berat</div>
                    </div>
                </div>

                <!-- Grid Komponen Bangunan -->
                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
                        Nilai Kondisi Komponen
                    </h2>

                    @php
                        $komponen = [
                            'pondasi' => 'Pondasi',
                            'struktur' => 'Struktur',
                            'atap' => 'Atap',
                            'dinding' => 'Dinding',
                            'lantai' => 'Lantai',
                            'plafon' => 'Plafon',
                            'pintu' => 'Pintu',
                            'jendela' => 'Jendela',
                            'listrik' => 'Listrik',
                            'sanitasi' => 'Sanitasi',
                        ];
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($komponen as $field => $label)
                            <div class="rounded-2xl bg-white/60 border border-slate-200/70 p-4 transition hover:border-violet-300">
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                    {{ $label }} <span class="text-rose-500">*</span>
                                </label>
                                <select name="{{ $field }}"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-800 shadow-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-200/50 outline-none transition"
                                    required>
                                    @for ($i = 5; $i >= 1; $i--)
                                        @php
                                            $labelKondisi = match ($i) {
                                                5 => '5 - Sangat Baik',
                                                4 => '4 - Baik',
                                                3 => '3 - Rusak Ringan',
                                                2 => '2 - Rusak Sedang',
                                                1 => '1 - Rusak Berat',
                                            };
                                        @endphp
                                        <option value="{{ $i }}"
                                            {{ old($field, $dataSet->$field) == $i ? 'selected' : '' }}>
                                            {{ $labelKondisi }}
                                        </option>
                                    @endfor
                                </select>
                                @error($field)
                                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Label Kategori Target -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Kategori Kelayakan (Target Klasifikasi) <span class="text-rose-500">*</span>
                        </label>
                        <select name="kategori"
                            class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-200/50 outline-none transition"
                            required>
                            @foreach (['Layak', 'Kurang Layak', 'Tidak Layak'] as $kat)
                                <option value="{{ $kat }}"
                                    {{ old('kategori', $dataSet->kategori) == $kat ? 'selected' : '' }}>
                                    {{ $kat }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Keterangan Tambahan
                        </label>
                        <input type="text" name="keterangan" value="{{ old('keterangan', $dataSet->keterangan) }}"
                            placeholder="Catatan tambahan (opsional)..."
                            class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-violet-400 focus:ring-2 focus:ring-violet-200/50 outline-none transition">
                        @error('keterangan')
                            <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="pt-6 border-t border-slate-200/60 flex items-center justify-end gap-3">
                    <a href="{{ route('data-set.index') }}"
                        class="px-5 py-2.5 rounded-2xl border border-slate-200 bg-white text-slate-600 text-xs font-semibold hover:bg-slate-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-violet-600 px-6 py-2.5 text-xs font-semibold text-white shadow-lg shadow-violet-600/30 hover:bg-violet-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Data Latih
                    </button>
                </div>

            </form>

        </div>

    </div>

</x-app-layout>
