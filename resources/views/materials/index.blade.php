<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between w-full">

            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Daftar Data Material </h2>

                <p class="text-xs text-slate-500 mt-1">
                    Manajemen data material pendukung pekerjaan
                </p>
            </div>

            <a href="{{ route('materials.create') }}"
                class="inline-flex items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl shadow-sm transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                </svg>

                Tambah Material
            </a>

            <form action="{{ route('materials.import') }}" method="POST" enctype="multipart/form-data"
                class="flex gap-3">

                @csrf

                <input type="file" name="excel" class="border rounded-lg p-2" required>

                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">

                    Import Excel

                </button>

            </form>

        </div>
    </x-slot>

    <div class="py-10">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">

                <div class="p-6">

                    @if (session('success'))
                        <div class="mb-5 px-4 py-3 rounded-lg bg-emerald-50 text-emerald-700 text-sm">

                            {{ session('success') }}

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

                    <div class="overflow-x-auto">

                        <table class="w-full text-sm">

                            <thead class="bg-slate-50">

                                <tr>

                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase">
                                        No
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase">
                                        Nama Bahan
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase">
                                        Satuan
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase">
                                        Harga
                                    </th>

                                    <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($materials as $material)
                                    <tr class="border-t hover:bg-slate-50">

                                        <td class="px-6 py-4">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 font-semibold text-slate-800">

                                            {{ $material->nama_bahan }}

                                        </td>

                                        <td class="px-6 py-4">

                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700">

                                                {{ $material->satuan }}

                                            </span>

                                        </td>

                                        <td class="px-6 py-4 font-semibold text-indigo-600">

                                            Rp {{ number_format($material->harga_satuan, 0, ',', '.') }}

                                        </td>

                                        <td class="px-6 py-4">

                                            <div class="flex justify-center gap-2">

                                                <a href="{{ route('materials.show', $material->id) }}"
                                                    class="px-3 py-1.5 rounded-lg bg-emerald-100 text-emerald-700 text-xs font-bold hover:bg-emerald-200">

                                                    Detail

                                                </a>

                                                <a href="{{ route('materials.edit', $material->id) }}"
                                                    class="px-3 py-1.5 rounded-lg bg-amber-100 text-amber-700 text-xs font-bold hover:bg-amber-200">

                                                    Edit

                                                </a>

                                                <form action="{{ route('materials.destroy', $material->id) }}"
                                                    method="POST" onsubmit="return confirm('Hapus data ini?')">

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        class="px-3 py-1.5 rounded-lg bg-rose-100 text-rose-700 text-xs font-bold hover:bg-rose-200">

                                                        Hapus

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5" class="text-center py-10 text-slate-500">

                                            Belum ada data material

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-5">

                        {{ $materials->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
