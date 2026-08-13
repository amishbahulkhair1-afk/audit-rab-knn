<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between w-full">

            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Daftar Data Equipment </h2>

                <p class="text-xs text-slate-500 mt-1">
                    Manajemen data peralatan dan alat kerja konstruksi
                </p>
            </div>

            <a href="{{ route('equipments.create') }}"
                class="inline-flex items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl shadow-sm transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                </svg>

                Tambah Equipment
            </a>

            <form action="{{ route('equipments.import') }}" method="POST" enctype="multipart/form-data"
                class="flex items-center gap-3">

                @csrf

                <input type="file" name="excel" required class="border rounded-lg p-2">

                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">

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

                <div
                    class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl shadow-sm">

                    <p class="font-bold mb-2">
                        Data gagal diimport:
                    </p>

                    <ul class="list-disc ml-5">

                        @foreach (session('import_errors') as $error)
                            <li>
                                Baris {{ $error['baris'] }} :
                                {{ $error['pesan'] }}
                            </li>
                        @endforeach

                    </ul>

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
                                    Nama Alat</th>
                                <th scope="col"
                                    class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase tracking-wider text-xs">
                                    Satuan</th>
                                <th scope="col"
                                    class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase tracking-wider text-xs">
                                    Harga Satuan</th>
                                <th scope="col"
                                    class="px-6 py-3.5 text-center font-bold text-gray-700 uppercase tracking-wider text-xs">
                                    Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($equipments as $equipment)
                                <tr class="hover:bg-slate-50/50 transition duration-100">
                                    <!-- Kode Equipment -->
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-600">
                                        {{ $equipment->kode }}
                                    </td>

                                    <!-- Nama Alat -->
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                        {{ $equipment->nama_alat }}
                                    </td>

                                    <!-- Satuan -->
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 text-xs font-semibold bg-slate-100 text-slate-700 rounded border border-slate-200">
                                            {{ $equipment->satuan }}
                                        </span>
                                    </td>

                                    <!-- Harga Satuan terformat -->
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-700">
                                        Rp {{ number_format($equipment->harga_satuan, 0, ',', '.') }}
                                    </td>

                                    <!-- Kelompok Tombol Aksi -->
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-xs font-semibold space-x-1">
                                        <!-- Detail -->
                                        <a href="{{ route('equipments.show', $equipment->id) }}"
                                            class="inline-flex items-center px-2.5 py-1.5 bg-slate-50 text-slate-700 border border-slate-200 rounded-md hover:bg-slate-100 transition duration-150">
                                            Detail
                                        </a>

                                        <!-- Edit -->
                                        <a href="{{ route('equipments.edit', $equipment->id) }}"
                                            class="inline-flex items-center px-2.5 py-1.5 bg-amber-50 text-amber-700 border border-amber-200 rounded-md hover:bg-amber-100 transition duration-150">
                                            Edit
                                        </a>

                                        <!-- Hapus -->
                                        <form action="{{ route('equipments.destroy', $equipment->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data equipment ini?')"
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
                                            <span>Belum ada data alat atau inventaris yang tersimpan.</span>
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
                {{ $equipments->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
