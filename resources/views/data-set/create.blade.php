<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Tambah Data Latih KNN') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-8">

                    <!-- Komponen Error Validasi Global Kustom -->
                    @if ($errors->any())
                        <div class="mb-6">
                            <x-input-error :messages="$errors->all()" />
                        </div>
                    @endif

                    <form action="{{ route('data-set.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Baris Atas: Kode & Nama Bangunan -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <x-input-label value="Kode Data" />
                                <x-text-input type="text" value="Otomatis dibuat sistem" disabled />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="nama_bangunan" value="Nama Bangunan" :required="true" />
                                <x-text-input id="nama_bangunan" type="text" name="nama_bangunan" :value="old('nama_bangunan')" required autofocus />
                            </div>
                        </div>

                        <!-- Jenis Konstruksi -->
                        <div>
                            <x-input-label for="jenis_konstruksi" value="Jenis Konstruksi" :required="true" />
                            <select name="jenis_konstruksi" id="jenis_konstruksi" 
                                    class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-lg shadow-xs text-gray-900 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 transition duration-150" 
                                    required>
                                <option value="">-- Pilih Jenis Konstruksi --</option>
                                @foreach(['Gedek', 'Semi Permanen', 'Permanen', 'Permanen Bertingkat'] as $jenis)
                                    <option value="{{ $jenis }}" {{ old('jenis_konstruksi') == $jenis ? 'selected' : '' }}>
                                        {{ $jenis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Banner Info Skala Penilaian -->
                        <div class="p-4.5 bg-indigo-50/60 rounded-xl border border-indigo-100/80 flex gap-3 text-sm text-indigo-900">
                            <svg class="w-5 h-5 text-indigo-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <span class="font-bold tracking-wide">Skala Penilaian Kondisi:</span>
                                <div class="grid grid-cols-2 sm:grid-cols-5 gap-2 mt-2 font-medium text-indigo-800/90 text-xs">
                                    <div class="bg-white/80 px-2.5 py-1 rounded border border-indigo-100">5 = Sangat Baik</div>
                                    <div class="bg-white/80 px-2.5 py-1 rounded border border-indigo-100">4 = Baik</div>
                                    <div class="bg-white/80 px-2.5 py-1 rounded border border-indigo-100">3 = Rusak Ringan</div>
                                    <div class="bg-white/80 px-2.5 py-1 rounded border border-indigo-100">2 = Rusak Sedang</div>
                                    <div class="bg-white/80 px-2.5 py-1 rounded border border-indigo-100">1 = Rusak Berat</div>
                                </div>
                            </div>
                        </div>

                        <!-- Grid Penilaian Komponen Bangunan (Kondisi 1 - 5) -->
                        <div>
                            <h3 class="text-sm font-bold text-gray-800 tracking-wide uppercase mb-3">Nilai Kondisi Komponen</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 bg-slate-50/50 p-5 rounded-xl border border-slate-100">
                                @php
                                    $komponen = [
                                        'pondasi' => 'Pondasi', 'struktur' => 'Struktur', 'atap' => 'Atap',
                                        'dinding' => 'Dinding', 'lantai' => 'Lantai', 'plafon' => 'Plafon',
                                        'pintu' => 'Pintu', 'jendela' => 'Jendela', 'listrik' => 'Listrik',
                                        'sanitasi' => 'Sanitasi',
                                    ];
                                @endphp

                                @foreach ($komponen as $field => $label)
                                    <div>
                                        <x-input-label :for="$field" :value="$label" :required="true" />
                                        <select name="{{ $field }}" id="{{ $field }}" 
                                                class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-lg shadow-xs text-gray-900 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 transition duration-150" 
                                                required>
                                            <option value="">-- Pilih --</option>
                                            @for ($i = 5; $i >= 1; $i--)
                                                <option value="{{ $i }}" {{ old($field) == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div>
                            <x-input-label for="keterangan" value="Keterangan Tambahan" />
                            <textarea id="keterangan" name="keterangan" rows="3" 
                                      class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-lg shadow-xs text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 transition duration-150">{{ old('keterangan') }}</textarea>
                        </div>

                        <!-- Target Kategori Kelayakan -->
                        <div>
                            <x-input-label for="kategori" value="Kategori Kelayakan (Label Data Latih)" :required="true" />
                            <select name="kategori" id="kategori" 
                                    class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-lg shadow-xs text-gray-900 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 transition duration-150" 
                                    required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach(['Layak', 'Kurang Layak', 'Tidak Layak'] as $kat)
                                    <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>
                                        {{ $kat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tombol Aksi Akhir -->
                        <div class="pt-4 flex justify-end gap-3 border-t border-slate-100">
                            <x-secondary-button onclick="window.location='{{ route('data-set.index') }}'">
                                {{ __('Kembali') }}
                            </x-secondary-button>

                            <x-primary-button>
                                {{ __('Simpan Data Latih') }}
                            </x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>