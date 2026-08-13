<x-app-layout>

    <x-slot name="header">

        <div class="w-full flex justify-between items-center">

            {{-- Judul --}}
            <div>

                <h2 class="font-bold text-xl text-slate-900">
                    Daftar Analisis Harga Satuan Pekerjaan (AHSP)
                </h2>

                <p class="text-xs text-slate-500 mt-1">
                    Manajemen standar analisis pekerjaan konstruksi dan komponen RAB
                </p>

            </div>


            {{-- Button Tambah Audit --}}
            <div>

                <a href="{{ route('ahsps.create') }}"
                    class="
                inline-flex
                items-center
                gap-2

                px-5
                py-3

                rounded-xl

                bg-gradient-to-r
                from-emerald-600
                to-emerald-500

                text-white

                font-semibold

                shadow-md

                hover:shadow-lg

                transition
                ">


                    {{-- Hero Icon Plus --}}

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                    </svg>


                    AHSP Baru


                </a>

            </div>


        </div>


    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 shadow-sm flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Kontainer Tabel -->
            <div class="bg-white shadow rounded-lg overflow-hidden p-4">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 text-sm">
                                <th class="border border-gray-200 p-3 text-center w-24">Kode</th>
                                <th class="border border-gray-200 p-3 text-left">Nama Pekerjaan</th>
                                <th class="border border-gray-200 p-3 text-center w-24">Satuan</th>
                                <th class="border border-gray-200 p-3 text-center w-60">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="text-gray-600 text-sm">
                            @forelse($ahsps as $ahsp)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="border border-gray-200 p-3 text-center font-mono font-semibold">
                                        {{ $ahsp->kode }}
                                    </td>
                                    <td class="border border-gray-200 p-3">
                                        {{ $ahsp->nama_pekerjaan }}
                                    </td>
                                    <td class="border border-gray-200 p-3 text-center">
                                        <span class="bg-gray-200 text-gray-800 px-2 py-0.5 rounded text-xs font-medium">
                                            {{ $ahsp->satuan }}
                                        </span>
                                    </td>
                                    <td class="border border-gray-200 p-3 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Tombol Detail -->
                                            <a href="{{ route('ahsps.show', $ahsp) }}"
                                                class="bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-1.5 rounded text-xs font-medium shadow-sm transition">
                                                Detail
                                            </a>

                                            <!-- Tombol Edit -->
                                            <a href="{{ route('ahsps.edit', $ahsp) }}"
                                                class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1.5 rounded text-xs font-medium shadow-sm transition">
                                                Edit
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('ahsps.destroy', $ahsp) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data AHSP ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-rose-500 hover:bg-rose-600 text-white px-3 py-1.5 rounded text-xs font-medium shadow-sm transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center p-8 text-gray-400 italic">
                                        Belum ada data AHSP yang tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($ahsps->hasPages())
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        {{ $ahsps->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>

</x-app-layout>
