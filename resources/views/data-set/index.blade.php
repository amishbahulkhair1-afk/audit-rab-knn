<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Data Latih KNN') }}
            </h2>

            <a href="{{ route('data-set.create') }}"
                class="inline-flex items-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white text-sm font-semibold tracking-wide rounded-lg shadow-sm transition duration-150">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Data Latih
            </a>
            <form action="{{ route('data-set.import') }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                @csrf

                <input type="file" name="excel" accept=".xlsx,.xls,.csv" required
                    class="block w-full sm:w-auto text-sm
               text-slate-600
               border border-slate-300
               rounded-lg
               cursor-pointer
               bg-white
               p-2">

                <button type="submit"
                    class="bg-emerald-600
               hover:bg-emerald-700
               text-white
               px-5 py-2.5
               rounded-lg
               font-semibold
               transition">
                    Import Excel
                </button>

            </form>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            <!-- Banner Notifikasi Sukses -->
            @if (session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex gap-3 text-sm text-emerald-800">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('import_errors') && count(session('import_errors')) > 0)

                <div class="mt-4 bg-red-50 border border-red-200 rounded-xl p-5">

                    <h3 class="font-bold text-red-700 mb-3">
                        Beberapa data gagal diimport
                    </h3>

                    <div class="space-y-2">

                        @foreach (session('import_errors') as $error)
                            <div class="text-sm text-red-600">
                                <strong>Baris {{ $error['baris'] }}</strong> :
                                {{ $error['pesan'] }}
                            </div>
                        @endforeach

                    </div>

                </div>

            @endif

            <!-- Wadah Utama Tabel -->
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase tracking-wider text-xs">
                                    Kode</th>
                                <th scope="col"
                                    class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase tracking-wider text-xs">
                                    Nama Bangunan</th>
                                <th scope="col"
                                    class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase tracking-wider text-xs">
                                    Jenis Konstruksi</th>
                                <th scope="col"
                                    class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase tracking-wider text-xs">
                                    Kategori Kelayakan</th>
                                <th scope="col"
                                    class="px-6 py-3.5 text-center font-bold text-gray-700 uppercase tracking-wider text-xs">
                                    Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($dataSet as $data)
                                <tr class="hover:bg-slate-50/50 transition duration-100">
                                    <!-- Kode Data -->
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-600">
                                        {{ $data->kode_data }}
                                    </td>

                                    <!-- Nama Bangunan -->
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                        {{ $data->nama_bangunan }}
                                    </td>

                                    <!-- Jenis Konstruksi -->
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                        {{ $data->jenis_konstruksi }}
                                    </td>

                                    <!-- Kategori Status Kelayakan (Badge) -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $warnaBadge = match ($data->kategori) {
                                                'Layak' => 'bg-emerald-50 text-emerald-700 border-emerald-200/60',
                                                'Kurang Layak' => 'bg-amber-50 text-amber-700 border-amber-200/60',
                                                'Tidak Layak' => 'bg-rose-50 text-rose-700 border-rose-200/60',
                                                default => 'bg-gray-50 text-gray-700 border-gray-200',
                                            };
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-md border {{ $warnaBadge }}">
                                            {{ $data->kategori }}
                                        </span>
                                    </td>

                                    <!-- Kelompok Tombol Aksi -->
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-xs font-semibold space-x-1">
                                        <!-- Detail -->
                                        <a href="{{ route('data-set.show', $data->id) }}"
                                            class="inline-flex items-center px-2.5 py-1.5 bg-slate-50 text-slate-700 border border-slate-200 rounded-md hover:bg-slate-100 transition duration-150">
                                            Detail
                                        </a>

                                        <!-- Edit -->
                                        <a href="{{ route('data-set.edit', $data->id) }}"
                                            class="inline-flex items-center px-2.5 py-1.5 bg-amber-50 text-amber-700 border border-amber-200 rounded-md hover:bg-amber-100 transition duration-150">
                                            Edit
                                        </a>

                                        <!-- Hapus -->
                                        <form action="{{ route('data-set.destroy', $data->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data latih ini?')"
                                                class="inline-flex items-center px-2.5 py-1.5 bg-rose-50 text-rose-600 border border-rose-200 rounded-md hover:bg-rose-100 transition duration-150">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400 font-medium">
                                        <div class="flex flex-col items-center justify-center space-y-2">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <span>Belum ada data latih yang tersimpan.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Bagian Navigasi Halaman (Pagination) -->
            <div class="pt-2">
                {{ $dataSet->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
