<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Edit Data Latih KNN') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-8">

                    <!-- Komponen Error Validasi Global -->
                    @if ($errors->any())
                        <div class="mb-6">
                            <x-input-error :messages="$errors->all()" />
                        </div>
                    @endif

                    <form action="{{ route('data-set.update', $dataSet->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Identitas Bangunan -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2">
                                <x-input-label for="nama_bangunan" value="Nama Bangunan" :required="true" />
                                <x-text-input id="nama_bangunan" type="text" name="nama_bangunan" :value="old('nama_bangunan', $dataSet->nama_bangunan)"
                                    required autofocus />
                            </div>
                            <div>
                                <x-input-label for="jenis_konstruksi" value="Jenis Konstruksi" :required="true" />
                                <select name="jenis_konstruksi" id="jenis_konstruksi"
                                    class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-lg shadow-xs text-gray-900 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 transition duration-150"
                                    required>
                                    @foreach (['Gedek', 'Semi Permanen', 'Permanen', 'Permanen Bertingkat'] as $jenis)
                                        <option value="{{ $jenis }}"
                                            {{ old('jenis_konstruksi', $dataSet->jenis_konstruksi) == $jenis ? 'selected' : '' }}>
                                            {{ $jenis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Grid Penilaian Komponen Bangunan -->
                        <div>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
                                <h3 class="text-sm font-bold text-gray-800 tracking-wide uppercase">Nilai Kondisi
                                    Komponen</h3>
                                <span class="text-xs text-slate-500 font-medium">(Skala: 5 = Sangat Baik, 1 = Rusak
                                    Berat)</span>
                            </div>

                            <div
                                class="grid grid-cols-1 sm:grid-cols-2 gap-5 bg-slate-50/50 p-5 rounded-xl border border-slate-100">
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

                                @foreach ($komponen as $field => $label)
                                    <div>
                                        <x-input-label :for="$field" :value="$label" :required="true" />
                                        <select name="{{ $field }}" id="{{ $field }}"
                                            class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-lg shadow-xs text-gray-900 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 transition duration-150"
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
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div>
                            <x-input-label for="keterangan" value="Keterangan Tambahan" />
                            <textarea id="keterangan" name="keterangan" rows="3"
                                class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-lg shadow-xs text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 transition duration-150">{{ old('keterangan', $dataSet->keterangan) }}</textarea>
                        </div>

                        <!-- Target Kategori Kelayakan -->
                        <div>
                            <x-input-label for="kategori" value="Kategori Kelayakan (Label Data Latih)"
                                :required="true" />
                            <select name="kategori" id="kategori"
                                class="w-full px-3.5 py-2.5 text-sm bg-white border border-gray-200 rounded-lg shadow-xs text-gray-900 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 transition duration-150"
                                required>
                                @foreach (['Layak', 'Kurang Layak', 'Tidak Layak'] as $kat)
                                    <option value="{{ $kat }}"
                                        {{ old('kategori', $dataSet->kategori) == $kat ? 'selected' : '' }}>
                                        {{ $kat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tombol Aksi Akhir -->
                        <div class="pt-4 flex justify-end gap-3 border-t border-slate-100">
                            <x-secondary-button onclick="window.location='{{ route('data-set.index') }}'">
                                {{ __('Batal') }}
                            </x-secondary-button>

                            <x-primary-button>
                                {{ __('Update Data Latih') }}
                            </x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
