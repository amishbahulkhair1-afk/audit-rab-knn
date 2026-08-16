<x-app-layout>

    <x-slot name="header">
        Tambah Audit
    </x-slot>

    <div class="space-y-5">

        {{-- =========================================
             HERO / HEADER CARD
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 p-5 md:p-6 text-white shadow-xl">

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
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-white/70 mb-1">
                            Manajemen Audit
                        </p>
                        <h1 class="text-xl md:text-2xl font-bold leading-tight">
                            Tambah Audit Kondisi Bangunan
                        </h1>
                        <p class="text-xs md:text-sm text-white/80 mt-1">
                            Input hasil survei penilaian kondisi komponen bangunan untuk klasifikasi KNN otomatis.
                        </p>
                    </div>

                </div>

                <a href="{{ route('audits.index') }}"
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

            <form action="{{ route('audits.store') }}" method="POST" class="space-y-8">

                @csrf

                {{-- DATA UTAMA --}}
                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                        Informasi Utama Audit
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Tanggal Audit --}}
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                Tanggal Audit <span class="text-rose-500">*</span>
                            </label>
                            <input type="date" name="tanggal_audit"
                                value="{{ old('tanggal_audit', date('Y-m-d')) }}"
                                class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-amber-400 focus:ring-2 focus:ring-amber-200/50 outline-none transition"
                                required>
                            @error('tanggal_audit')
                                <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Bangunan --}}
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                Pilih Bangunan <span class="text-rose-500">*</span>
                            </label>
                            <select name="building_id"
                                class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-amber-400 focus:ring-2 focus:ring-amber-200/50 outline-none transition"
                                required>
                                <option value="">-- Pilih Bangunan --</option>
                                @foreach ($buildings as $building)
                                    <option value="{{ $building->id }}"
                                        {{ old('building_id') == $building->id ? 'selected' : '' }}>
                                        [{{ $building->kode_bangunan }}] {{ $building->nama_bangunan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('building_id')
                                <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- INFO SKALA PENILAIAN --}}
                <div class="rounded-2xl bg-amber-500/10 border border-amber-500/20 p-4">
                    <p class="text-xs font-bold uppercase tracking-wider text-amber-800 mb-2">
                        Skala Penilaian Kondisi (1 - 5):
                    </p>
                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-2 text-xs font-medium text-amber-900">
                        <div class="bg-white/80 rounded-xl px-3 py-1.5 border border-amber-200/50 text-center">5 = Sangat Baik</div>
                        <div class="bg-white/80 rounded-xl px-3 py-1.5 border border-amber-200/50 text-center">4 = Baik</div>
                        <div class="bg-white/80 rounded-xl px-3 py-1.5 border border-amber-200/50 text-center">3 = Rusak Ringan</div>
                        <div class="bg-white/80 rounded-xl px-3 py-1.5 border border-amber-200/50 text-center">2 = Rusak Sedang</div>
                        <div class="bg-white/80 rounded-xl px-3 py-1.5 border border-amber-200/50 text-center">1 = Rusak Berat</div>
                    </div>
                </div>

                {{-- PENILAIAN KOMPONEN --}}
                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-orange-500"></span>
                        Penilaian Kondisi Komponen Bangunan
                    </h2>

                    @php
                        $komponen = [
                            'pondasi' => 'Pondasi',
                            'struktur' => 'Struktur Kolom/Balok',
                            'atap' => 'Atap & Rangka',
                            'dinding' => 'Dinding & Partisi',
                            'lantai' => 'Lantai / Keramik',
                            'plafon' => 'Plafon',
                            'pintu' => 'Pintu & Kusen',
                            'jendela' => 'Jendela & Kaca',
                            'listrik' => 'Elektrikal',
                            'sanitasi' => 'Sanitasi & Plumbing',
                        ];
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($komponen as $field => $label)
                            <div class="rounded-2xl bg-white/60 border border-slate-200/70 p-4 transition hover:border-amber-300">
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                    {{ $label }} <span class="text-rose-500">*</span>
                                </label>
                                <select name="{{ $field }}"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-800 shadow-sm focus:border-amber-400 focus:ring-2 focus:ring-amber-200/50 outline-none transition"
                                    required>
                                    <option value="">-- Pilih Nilai Kondisi --</option>
                                    <option value="5" {{ old($field) == '5' ? 'selected' : '' }}>5 - Sangat Baik</option>
                                    <option value="4" {{ old($field) == '4' ? 'selected' : '' }}>4 - Baik</option>
                                    <option value="3" {{ old($field) == '3' ? 'selected' : '' }}>3 - Rusak Ringan</option>
                                    <option value="2" {{ old($field) == '2' ? 'selected' : '' }}>2 - Rusak Sedang</option>
                                    <option value="1" {{ old($field) == '1' ? 'selected' : '' }}>1 - Rusak Berat</option>
                                </select>
                                @error($field)
                                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- CATATAN LAPANGAN --}}
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Catatan Lapangan
                    </label>
                    <textarea name="catatan" rows="3" placeholder="Masukkan catatan hasil pemeriksaan lapangan (opsional)..."
                        class="w-full rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 text-sm text-slate-800 shadow-sm focus:border-amber-400 focus:ring-2 focus:ring-amber-200/50 outline-none transition">{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- BUTTONS --}}
                <div class="pt-6 border-t border-slate-200/60 flex items-center justify-end gap-3">
                    <a href="{{ route('audits.index') }}"
                        class="px-5 py-2.5 rounded-2xl border border-slate-200 bg-white text-slate-600 text-xs font-semibold hover:bg-slate-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-amber-600 px-6 py-2.5 text-xs font-semibold text-white shadow-lg shadow-amber-600/30 hover:bg-amber-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan & Proses Audit
                    </button>
                </div>

            </form>

        </div>

    </div>

</x-app-layout>
