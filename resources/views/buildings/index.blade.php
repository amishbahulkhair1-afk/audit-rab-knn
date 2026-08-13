<x-app-layout>

    <x-slot name="header">

        <div class="w-full flex items-center justify-between">

            {{-- Judul kiri --}}
            <div>

                <h2 class="font-bold text-xl text-slate-900">
                    Manajemen Bangunan
                </h2>

                <p class="text-xs text-slate-500 mt-1">
                    Kelola data bangunan yang digunakan dalam proses audit kelayakan.
                </p>

            </div>

            {{-- Tombol kanan --}}
            <a href="{{ route('buildings.create') }}"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 text-white px-5 py-3 rounded-xl font-semibold shadow-md hover:shadow-lg transition">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />

                </svg>

                Tambah Bangunan

            </a>
            <form action="{{ route('buildings.import') }}" method="POST" enctype="multipart/form-data"
                class="flex items-center gap-3">

                @csrf

                <input type="file" name="excel" required class="border rounded-lg p-2">

                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">

                    Import Excel

                </button>

            </form>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- SUCCESS ALERT --}}
            @if (session('success'))
                <div
                    class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-2xl shadow-sm">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />

                    </svg>

                    <span class="font-medium">

                        {{ session('success') }}

                    </span>

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

            {{-- TABLE CARD --}}

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">

                {{-- CARD HEADER --}}

                <div class="px-6 py-5 border-b border-slate-100 flex items-center gap-4">

                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">

                        {{-- Building Icon --}}

                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6" />

                        </svg>

                    </div>

                    <div>

                        <h3 class="font-bold text-lg text-slate-900">

                            Daftar Bangunan

                        </h3>

                        <p class="text-sm text-slate-500">

                            Total data bangunan terdaftar

                        </p>

                    </div>

                </div>

                {{-- TABLE --}}

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead>

                            <tr class="bg-slate-50 text-slate-500 uppercase text-xs tracking-wider">

                                <th class="px-6 py-4 text-left">
                                    Kode
                                </th>

                                <th class="px-6 py-4 text-left">
                                    Nama Bangunan
                                </th>

                                <th class="px-6 py-4 text-left">
                                    Rayon
                                </th>

                                <th class="px-6 py-4 text-left">
                                    Luas
                                </th>

                                <th class="px-6 py-4 text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse($buildings as $building)
                                <tr class="hover:bg-slate-50 transition">

                                    <td class="px-6 py-4 font-mono font-semibold text-slate-800">

                                        {{ $building->kode_bangunan }}

                                    </td>

                                    <td class="px-6 py-4 font-semibold text-slate-800">

                                        {{ $building->nama_bangunan }}

                                    </td>

                                    <td class="px-6 py-4">

                                        <span
                                            class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold">

                                            {{ $building->rayon }}

                                        </span>

                                    </td>

                                    <td class="px-6 py-4 text-slate-600">

                                        {{ $building->luas_bangunan }}

                                        m²

                                    </td>

                                    <td class="px-6 py-4">

                                        <div class="flex justify-center gap-2">

                                            {{-- DETAIL --}}

                                            <a href="{{ route('buildings.show', $building) }}"
                                                class="inline-flex items-center gap-1 px-3 py-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 text-xs font-semibold transition">

                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">

                                                    <path stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                                </svg>

                                                Detail

                                            </a>

                                            {{-- EDIT --}}

                                            <a href="{{ route('buildings.edit', $building) }}"
                                                class="px-3 py-2 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 text-xs font-semibold transition">

                                                Edit

                                            </a>

                                            {{-- DELETE --}}

                                            <form action="{{ route('buildings.destroy', $building) }}" method="POST"
                                                onsubmit="return confirm('Hapus data bangunan ini?')">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                    class="px-3 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 text-xs font-semibold transition">

                                                    Hapus

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="text-center py-12 text-slate-400">

                                        Belum ada data bangunan.

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- PAGINATION --}}

                @if ($buildings->hasPages())
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">

                        {{ $buildings->links() }}

                    </div>
                @endif

            </div>

        </div>

    </div>

</x-app-layout>
