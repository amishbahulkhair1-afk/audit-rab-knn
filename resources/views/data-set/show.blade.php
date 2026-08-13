<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Detail Data Latih KNN') }}
            </h2>
            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-slate-100 text-slate-700 rounded-lg border border-slate-200">
                ID: {{ $dataSet->id }}
            </span>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card Utama: Ringkasan Informasi -->
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-xl border border-gray-100 p-6 md:p-8">
                <h3 class="text-sm font-bold text-gray-400 tracking-wide uppercase mb-4">Profil Bangunan</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <div class="space-y-1 p-4 bg-slate-50/60 rounded-lg border border-slate-100">
                        <span class="text-xs font-semibold text-slate-500 uppercase">Kode Data</span>
                        <div class="text-base font-bold text-slate-800">{{ $dataSet->kode_data }}</div>
                    </div>

                    <div class="space-y-1 p-4 bg-slate-50/60 rounded-lg border border-slate-100">
                        <span class="text-xs font-semibold text-slate-500 uppercase">Nama Bangunan</span>
                        <div class="text-base font-semibold text-slate-900">{{ $dataSet->nama_bangunan }}</div>
                    </div>

                    <div class="space-y-1 p-4 bg-slate-50/60 rounded-lg border border-slate-100">
                        <span class="text-xs font-semibold text-slate-500 uppercase">Jenis Konstruksi</span>
                        <div class="text-base text-slate-700">{{ $dataSet->jenis_konstruksi }}</div>
                    </div>

                    <div class="space-y-1 p-4 bg-slate-50/60 rounded-lg border border-slate-100">
                        <span class="text-xs font-semibold text-slate-500 uppercase">Kategori Kelayakan (Label)</span>
                        <div>
                            @php
                                $warnaBadge = match($dataSet->kategori) {
                                    'Layak' => 'bg-emerald-50 text-emerald-700 border-emerald-200/60',
                                    'Kurang Layak' => 'bg-amber-50 text-amber-700 border-amber-200/60',
                                    'Tidak Layak' => 'bg-rose-50 text-rose-700 border-rose-200/60',
                                    default => 'bg-gray-50 text-gray-700 border-gray-200'
                                };
                            @endphp
                            <span class="inline-flex items-center mt-0.5 px-3 py-1 text-sm font-bold rounded-md border {{ $warnaBadge }}">
                                {{ $dataSet->kategori }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Kedua: Parameter Nilai Komponen -->
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-xl border border-gray-100 p-6 md:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4">
                    <h3 class="text-sm font-bold text-gray-400 tracking-wide uppercase">Nilai Kondisi Komponen</h3>
                    <span class="text-xs text-slate-500 font-medium">(Skala 1 - 5)</span>
                </div>

                <div class="overflow-hidden border border-gray-100 rounded-lg shadow-xs">
                    <table class="min-w-full divide-y divide-gray-100 text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left font-semibold text-slate-700">Komponen Bangunan</th>
                                <th scope="col" class="px-6 py-3 text-center font-semibold text-slate-700 w-32">Nilai Atribut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white font-medium">
                            @php
                                $komponen = [
                                    'pondasi' => 'Pondasi', 'struktur' => 'Struktur', 'atap' => 'Atap',
                                    'dinding' => 'Dinding', 'lantai' => 'Lantai', 'plafon' => 'Plafon',
                                    'pintu' => 'Pintu', 'jendela' => 'Jendela', 'listrik' => 'Listrik',
                                    'sanitasi' => 'Sanitasi'
                                ];
                            @endphp

                            @foreach($komponen as $field => $label)
                                <tr class="hover:bg-slate-50/50 transition duration-100">
                                    <td class="px-6 py-3 text-gray-700">{{ $label }}</td>
                                    <td class="px-6 py-3 text-center">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-indigo-50 text-indigo-700 font-bold text-xs border border-indigo-100">
                                            {{ $dataSet->$field }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Bagian Catatan/Keterangan -->
                <div class="mt-6 space-y-2">
                    <span class="text-xs font-bold text-gray-400 tracking-wide uppercase block">Keterangan Tambahan</span>
                    <div class="p-4 bg-slate-50 text-slate-700 rounded-lg text-sm leading-relaxed border border-slate-100">
                        {{ $dataSet->keterangan ?? 'Tidak ada keterangan tambahan.' }}
                    </div>
                </div>

                <!-- Kelompok Tombol Aksi Akhir -->
                <div class="mt-8 pt-6 flex justify-end gap-3 border-t border-slate-100">
                    <x-secondary-button onclick="window.location='{{ route('data-set.index') }}'">
                        {{ __('Kembali') }}
                    </x-secondary-button>

                    <a href="{{ route('data-set.edit', $dataSet->id) }}" class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 active:bg-amber-700 text-white text-xs font-semibold uppercase tracking-widest rounded-md shadow-xs transition duration-150">
                        {{ __('Edit Data') }}
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>