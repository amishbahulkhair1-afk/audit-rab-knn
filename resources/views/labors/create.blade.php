<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                    {{ __('Tambah Data Upah') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Tambahkan data tenaga kerja dan standar upah harian
                </p>
            </div>
        </div>
    </x-slot>


    <div class="py-10">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">


            {{-- Error Validation --}}
            @if ($errors->any())

                <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-xl">

                    <div class="flex items-center gap-2 mb-2">

                        <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />

                        </svg>

                        <span class="font-semibold text-rose-700">
                            Terdapat kesalahan input
                        </span>

                    </div>


                    <ul class="list-disc ml-7 text-sm text-rose-600">

                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach

                    </ul>

                </div>

            @endif



            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 overflow-hidden">


                {{-- Header Card --}}

                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50">

                    <div class="flex items-center gap-3">

                        <div class="p-3 bg-indigo-100 rounded-xl">

                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />

                            </svg>

                        </div>


                        <div>

                            <h3 class="font-bold text-slate-800">
                                Informasi Tenaga Kerja
                            </h3>

                            <p class="text-xs text-slate-500">
                                Masukkan data pekerja dan nilai upah
                            </p>

                        </div>

                    </div>

                </div>



                {{-- Form --}}

                <div class="p-6 md:p-8">


                    <form action="{{ route('labors.store') }}" method="POST" class="space-y-6">

                        @csrf



                        {{-- Nama Pekerja --}}

                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">

                                Nama Pekerja
                                <span class="text-rose-500">*</span>

                            </label>


                            <input type="text" name="nama_pekerja" value="{{ old('nama_pekerja') }}"
                                placeholder="Contoh: Tukang Batu, Mandor, Pekerja Umum"
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-200 transition"
                                required>


                            @error('nama_pekerja')
                                <p class="text-sm text-rose-600 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror


                        </div>




                        {{-- Upah Harian --}}

                        <div>


                            <label class="block text-sm font-semibold text-slate-700 mb-2">

                                Upah Harian
                                <span class="text-rose-500">*</span>

                            </label>



                            <div class="relative">


                                <span
                                    class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 font-semibold">
                                    Rp
                                </span>


                                <input type="number" name="upah_harian" value="{{ old('upah_harian') }}"
                                    placeholder="Contoh: 150000" min="0"
                                    class="w-full pl-12 rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-200 transition"
                                    required>


                            </div>



                            @error('upah_harian')
                                <p class="text-sm text-rose-600 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror



                        </div>




                        {{-- Footer Button --}}

                        <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">


                            <a href="{{ route('labors.index') }}"
                                class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-sm font-semibold transition">

                                Batal

                            </a>



                            <button type="submit"
                                class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold shadow-sm transition">


                                <span class="flex items-center gap-2">


                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />

                                    </svg>


                                    Simpan Data


                                </span>


                            </button>


                        </div>



                    </form>


                </div>


            </div>


        </div>

    </div>


</x-app-layout>
