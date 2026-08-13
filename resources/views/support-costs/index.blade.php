<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between w-full">

            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Data Biaya Pendukung</h2>

                <p class="text-xs text-slate-500 mt-1">
                    Manajemen biaya tambahan dan kebutuhan pendukung konstruksi
                </p>
            </div>

            <a href="{{ route('support-costs.create') }}"
                class="inline-flex items-center px-4 py-2.5
                       bg-emerald-600 hover:bg-emerald-700
                       text-white rounded-xl shadow-sm transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                </svg>

                Tambah Biaya
            </a>
            <form action="{{ route('support-costs.import') }}" method="POST" enctype="multipart/form-data"
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
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div
                    class="mb-6 bg-emerald-50 text-emerald-700 px-6 py-4 rounded-xl border border-emerald-200 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('import_errors') && count(session('import_errors')) > 0)

                <div
                    class="
                    mb-6

                    flex
                    items-center
                    gap-3

                    bg-red-50

                    border
                    border-red-200

                    text-red-700

                    px-5
                    py-4

                    rounded-2xl

                    shadow-sm
                    ">

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

            <!-- Tabel Data -->
            <div class="bg-white shadow-xs sm:rounded-xl border border-slate-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <!-- Perbaikan pada THEAD -->
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Kode
                            </th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Nama
                                Biaya</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Kategori
                            </th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Harga
                            </th>
                            <!-- Tambahkan text-center agar kolom Aksi sejajar -->
                            <th
                                class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider text-center">
                                Aksi</th>
                        </tr>
                    </thead>

                    <!-- Perbaikan pada TBODY agar tombol rapi -->
                    <tbody class="divide-y divide-slate-100">
                        @forelse($supportCosts as $item)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $item->kode }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $item->nama_biaya }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-medium bg-slate-100 text-slate-800">
                                        {{ $item->kategori }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-900 font-mono">
                                    Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                </td>
                                <!-- Menggunakan text-center agar tombol di dalam sel tidak melayang -->
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <a href="{{ route('support-costs.show', $item) }}"
                                        class="text-emerald-600 hover:text-emerald-900 text-[10px] font-bold uppercase tracking-widest px-2">Detail</a>
                                    <a href="{{ route('support-costs.edit', $item) }}"
                                        class="text-amber-600 hover:text-amber-900 text-[10px] font-bold uppercase tracking-widest px-2">Edit</a>
                                    <form action="{{ route('support-costs.destroy', $item) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin hapus data ini?')"
                                            class="text-red-600 hover:text-red-900 text-[10px] font-bold uppercase tracking-widest px-2">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <!-- ... -->
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $supportCosts->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
