<x-app-layout>

    <x-slot name="header">

        <div class="w-full">

            <h2 class="font-bold text-2xl text-slate-900">

                Tambah Data Bangunan

            </h2>

            <p class="text-sm text-slate-500 mt-1">

                Masukkan informasi bangunan baru ke dalam sistem audit.

            </p>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">

                {{-- CARD HEADER --}}

                <div class="px-6 py-5 bg-slate-50 border-b border-slate-100 flex items-center gap-4">

                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">

                        {{-- Building Plus Icon --}}

                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M12 4v4m-2-2h4" />

                        </svg>

                    </div>

                    <div>

                        <h3 class="text-lg font-bold text-slate-900">

                            Form Bangunan Baru

                        </h3>

                        <p class="text-sm text-slate-500">

                            Lengkapi data sesuai kondisi bangunan.

                        </p>

                    </div>

                </div>

                {{-- FORM --}}

                <form action="{{ route('buildings.store') }}" method="POST" class="p-6">

                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- KODE --}}

                        <div>

                            <label class="text-sm font-semibold text-slate-700">

                                Kode Bangunan <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span>

                            </label>

                            <input type="text" name="kode_bangunan" value="{{ old('kode_bangunan') }}"
                                placeholder="Contoh: BGN-001"
                                class="mt-2 w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500">

                            @error('kode_bangunan')
                                <p class="text-red-500 text-xs mt-1">

                                    {{ $message }}

                                </p>
                            @enderror

                        </div>

                        {{-- NAMA --}}

                        <div>

                            <label class="text-sm font-semibold text-slate-700">

                                Nama Bangunan <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span>

                            </label>

                            <input type="text" name="nama_bangunan" value="{{ old('nama_bangunan') }}"
                                placeholder="Contoh: Gedung Madrasah"
                                class="mt-2 w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500">

                            @error('nama_bangunan')
                                <p class="text-red-500 text-xs mt-1">

                                    {{ $message }}

                                </p>
                            @enderror

                        </div>

                        {{-- JENIS BANGUNAN --}}

                        <div>

                            <label class="text-sm font-semibold text-slate-700">

                                Jenis Bangunan <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span>

                            </label>

                            <select name="jenis_bangunan"
                                class="mt-2 w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500">

                                <option value="">
                                    -- Pilih Jenis --
                                </option>

                                @foreach (['Masjid', 'Madrasah', 'Asrama', 'Gedung Serbaguna', 'Kantor'] as $jenis)
                                    <option value="{{ $jenis }}"
                                        {{ old('jenis_bangunan') == $jenis ? 'selected' : '' }}>

                                        {{ $jenis }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        {{-- KONSTRUKSI --}}

                        <div>

                            <label class="text-sm font-semibold text-slate-700">

                                Jenis Konstruksi <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span>

                            </label>

                            <select name="jenis_konstruksi"
                                class="mt-2 w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500">

                                <option value="">
                                    -- Pilih Konstruksi --
                                </option>

                                @foreach (['Gedek', 'Semi Permanen', 'Permanen', 'Permanen Bertingkat'] as $konstruksi)
                                    <option value="{{ $konstruksi }}"
                                        {{ old('jenis_konstruksi') == $konstruksi ? 'selected' : '' }}>

                                        {{ $konstruksi }}

                                    </option>
                                @endforeach

                            </select>

                            @error('jenis_konstruksi')
                                <p class="text-red-500 text-xs mt-1">

                                    {{ $message }}

                                </p>
                            @enderror

                        </div>

                        {{-- RAYON --}}

                        <div>

                            <label class="text-sm font-semibold text-slate-700">

                                Rayon <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span>

                            </label>

                            <input type="text" name="rayon" value="{{ old('rayon') }}"
                                placeholder="Contoh: Rayon A"
                                class="mt-2 w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500">

                        </div>

                        {{-- TAHUN --}}

                        <div>

                            <label class="text-sm font-semibold text-slate-700">

                                Tahun Berdiri

                            </label>

                            <input type="number" name="tahun_berdiri" value="{{ old('tahun_berdiri') }}"
                                placeholder="Contoh: 2015"
                                class="mt-2 w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500">

                        </div>

                        {{-- LUAS --}}

                        <div>

                            <label class="text-sm font-semibold text-slate-700">

                                Luas Bangunan (m²)

                            </label>

                            <input type="number" step="0.01" name="luas_bangunan"
                                value="{{ old('luas_bangunan') }}" placeholder="Contoh: 500"
                                class="mt-2 w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500">

                        </div>

                        {{-- ALAMAT --}}

                        <div class="md:col-span-2">

                            <label class="text-sm font-semibold text-slate-700">

                                Alamat Lengkap

                            </label>

                            <textarea name="alamat" rows="4" placeholder="Masukkan alamat bangunan..."
                                class="mt-2 w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500">{{ old('alamat') }}</textarea>

                        </div>

                    </div>

                    {{-- BUTTON --}}

                    <div class="mt-8 pt-5 border-t border-slate-100 flex justify-end gap-3">

                        <a href="{{ route('buildings.index') }}"
                            class="px-5 py-3 rounded-xl bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition">

                            Kembali

                        </a>

                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-500 text-white font-semibold shadow-md hover:shadow-lg transition">

                            {{-- Save Icon --}}

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M5 13l4 4L19 7" />

                            </svg>

                            Simpan Data

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
