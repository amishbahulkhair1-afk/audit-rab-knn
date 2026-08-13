<x-app-layout>

    <x-slot name="header">

        <div class="w-full flex items-center justify-between">

            {{-- Judul kiri --}}
            <div>

                <h2 class="font-bold text-xl text-slate-900">
                    Kelola Pekerja
                </h2>

                <p class="text-xs text-slate-500 mt-1">
                    Manajemen data tenaga kerja dan standar upah pembangunan
                </p>

            </div>



            {{-- Tombol kanan --}}
            <a href="{{ route('labors.create') }}"
                class="
            inline-flex
            items-center
            gap-2

            bg-gradient-to-r
            from-emerald-600
            to-emerald-500

            hover:from-emerald-700
            hover:to-emerald-600

            text-white

            px-5
            py-3

            rounded-xl

            font-semibold

            shadow-md

            hover:shadow-lg

            transition
            ">


                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />

                </svg>
                Tambah Pekerja
            </a>
            <form action="{{ route('labors.import') }}" method="POST" enctype="multipart/form-data"
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

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-5">


            {{-- NOTIFIKASI --}}
            @if (session('success'))
                <div
                    class="flex items-center gap-3 
                            p-4 rounded-xl
                            bg-emerald-50
                            border border-emerald-200
                            text-emerald-700 text-sm">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />

                    </svg>

                    <span class="font-medium">
                        {{ session('success') }}
                    </span>

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
            {{-- CARD TABLE --}}

            <div
                class="bg-white 
                        rounded-2xl
                        border border-slate-100
                        shadow-sm
                        overflow-hidden">


                <div class="overflow-x-auto">


                    <table class="min-w-full text-sm">


                        <thead>


                            <tr class="bg-slate-50 border-b border-slate-100">


                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-bold
                                           uppercase tracking-wider
                                           text-slate-500">

                                    Kode

                                </th>


                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-bold
                                           uppercase tracking-wider
                                           text-slate-500">

                                    Nama Pekerja

                                </th>


                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-bold
                                           uppercase tracking-wider
                                           text-slate-500">

                                    Upah Harian

                                </th>


                                <th
                                    class="px-6 py-4 text-center
                                           text-xs font-bold
                                           uppercase tracking-wider
                                           text-slate-500">

                                    Aksi

                                </th>


                            </tr>


                        </thead>




                        <tbody class="divide-y divide-slate-100">


                            @forelse($labors as $labor)
                                <tr class="hover:bg-slate-50 transition">


                                    {{-- KODE --}}

                                    <td class="px-6 py-4">


                                        <span
                                            class="inline-flex
                                                 px-3 py-1
                                                 rounded-lg
                                                 bg-slate-100
                                                 text-slate-700
                                                 border border-slate-200
                                                 text-xs
                                                 font-bold">

                                            {{ $labor->kode }}

                                        </span>


                                    </td>




                                    {{-- NAMA --}}

                                    <td class="px-6 py-4">


                                        <div class="font-semibold text-slate-900">

                                            {{ $labor->nama_pekerja }}

                                        </div>


                                        <div class="text-xs text-slate-400 mt-1">

                                            Tenaga kerja konstruksi

                                        </div>


                                    </td>





                                    {{-- UPAH --}}

                                    <td class="px-6 py-4">


                                        <span
                                            class="inline-flex
                                                 px-3 py-1
                                                 rounded-lg
                                                 bg-indigo-50
                                                 text-indigo-700
                                                 border border-indigo-100
                                                 font-semibold
                                                 text-xs">


                                            Rp
                                            {{ number_format($labor->upah_harian, 0, ',', '.') }}


                                        </span>


                                    </td>





                                    {{-- AKSI --}}

                                    <td class="px-6 py-4">


                                        <div class="flex justify-center gap-2">


                                            <a href="{{ route('labors.show', $labor->id) }}"
                                                class="px-3 py-1.5
                                                  rounded-lg
                                                  bg-slate-50
                                                  text-slate-700
                                                  border border-slate-200
                                                  text-xs font-semibold
                                                  hover:bg-slate-100">

                                                Detail

                                            </a>



                                            <a href="{{ route('labors.edit', $labor->id) }}"
                                                class="px-3 py-1.5
                                                  rounded-lg
                                                  bg-amber-50
                                                  text-amber-700
                                                  border border-amber-200
                                                  text-xs font-semibold
                                                  hover:bg-amber-100">

                                                Edit

                                            </a>




                                            <form action="{{ route('labors.destroy', $labor->id) }}" method="POST">

                                                @csrf
                                                @method('DELETE')


                                                <button type="submit"
                                                    onclick="return confirm('Hapus data pekerja ini?')"
                                                    class="px-3 py-1.5
                                                           rounded-lg
                                                           bg-rose-50
                                                           text-rose-600
                                                           border border-rose-200
                                                           text-xs font-semibold
                                                           hover:bg-rose-100">

                                                    Hapus

                                                </button>


                                            </form>


                                        </div>


                                    </td>



                                </tr>


                            @empty


                                <tr>

                                    <td colspan="4" class="px-6 py-14 text-center">


                                        <div class="flex flex-col items-center gap-3">


                                            <div
                                                class="w-12 h-12 rounded-full
                                                    bg-slate-100
                                                    flex items-center justify-center">


                                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />

                                                </svg>


                                            </div>


                                            <p class="text-sm text-slate-400">
                                                Belum ada data pekerja tersimpan.
                                            </p>


                                        </div>


                                    </td>


                                </tr>
                            @endforelse


                        </tbody>


                    </table>


                </div>


            </div>




            {{-- PAGINATION --}}

            <div>

                {{ $labors->links() }}

            </div>


        </div>

    </div>


</x-app-layout>
