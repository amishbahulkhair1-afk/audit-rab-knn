<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail (AHSP)
            </h2>
            <a href="{{ route('ahsps.index') }}"
                class="text-sm bg-gray-200 hover:bg-gray-600 text-gray-800 hover:text-white px-3 py-1.5 rounded-lg transition">
                Kembali ke Indeks
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Ringkasan Informasi Utama AHSP (Harga Satuan Kembali Dimasukkan) -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-center">
                    <div class="md:col-span-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Nama Pekerjaan</span>
                        <h3 class="text-xl font-bold text-gray-800 mt-0.5">
                            {{ $ahsp->nama_pekerjaan }}
                        </h3>
                    </div>
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Kode & Satuan</span>
                        <p class="text-base text-gray-700 mt-0.5">
                            <span class="font-mono font-semibold">{{ $ahsp->kode ?? '-' }}</span>
                            <span class="text-gray-400 mx-1">|</span>
                            <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs font-semibold">
                                Per {{ $ahsp->satuan }}
                            </span>
                        </p>
                    </div>
                    <!-- KOLOM HARGA SATUAN SUDAH KEMBALI DI SINI -->
                    <div class="bg-gray-50 p-3 rounded-lg border border-gray-100 text-right md:text-left">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Total Harga Satuan</span>
                        <p class="text-lg font-bold text-blue-600 mt-0.5">
                            Rp {{ number_format($ahsp->harga_satuan ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Header Tabel & Aksi -->
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-lg font-semibold text-gray-700">Rincian Komponen Koefisien</h4>
                <a href="{{ route('ahsps.edit', $ahsp->id) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow transition">
                    + Kelola & Edit Rincian
                </a>
            </div>

            <!-- Tabel Rincian Uraian Komponen -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 text-sm border-b border-gray-200">
                                <th class="p-3 text-center w-16">No</th>
                                <th class="p-3 text-left w-48">Jenis Komponen</th>
                                <th class="p-3 text-left">Uraian / Item Kelompok</th>
                                <th class="p-3 text-right w-36">Nilai Koefisien</th>
                            </tr>
                        </thead>

                        <tbody class="text-gray-600 text-sm divide-y divide-gray-100">
                            @forelse($ahsp->details as $detail)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="p-3 text-center font-medium text-gray-400">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="p-3">
                                        @if ($detail->jenis === 'material')
                                            <span
                                                class="px-2 py-1 rounded-md text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200">
                                                Material / Bahan
                                            </span>
                                        @elseif($detail->jenis === 'labor')
                                            <span
                                                class="px-2 py-1 rounded-md text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-200">
                                                Tenaga Kerja
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                Peralatan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-3 font-medium text-gray-800">
                                        {{ $detail->nama_item }}
                                    </td>
                                    <td class="p-3 text-right font-mono font-semibold text-gray-900 bg-gray-50/50">
                                        {{ number_format($detail->koefisien, 4, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-12 text-gray-400 italic">
                                        Belum ada rincian komponen koefisien untuk AHSP ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
