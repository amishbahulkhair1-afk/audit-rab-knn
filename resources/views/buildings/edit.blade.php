<x-app-layout>


    <x-slot name="header">

        <div class="w-full">

            <h2 class="font-bold text-2xl text-slate-900">

                Edit Data Bangunan

            </h2>


            <p class="text-sm text-slate-500 mt-1">

                Perbarui informasi bangunan yang telah terdaftar.

            </p>

        </div>

    </x-slot>





    <div class="py-8">


        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">


            <div

                class="
                bg-white

                rounded-3xl

                border
                border-slate-100

                shadow-sm

                overflow-hidden
                ">





                {{-- CARD HEADER --}}

                <div

                    class="
                    px-6
                    py-5

                    bg-slate-50

                    border-b
                    border-slate-100

                    flex
                    items-center
                    gap-4
                    ">


                    <div

                        class="
                        w-12
                        h-12

                        rounded-xl

                        bg-amber-50

                        text-amber-600

                        flex
                        items-center
                        justify-center
                        ">


                        {{-- Edit Icon --}}

                        <svg
                            class="w-6 h-6"

                            fill="none"

                            stroke="currentColor"

                            viewBox="0 0 24 24">


                            <path

                                stroke-width="2"

                                stroke-linecap="round"

                                stroke-linejoin="round"

                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-8.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 8.5-8.5"

                            />


                        </svg>


                    </div>



                    <div>

                        <h3 class="font-bold text-lg text-slate-900">

                            {{ $building->nama_bangunan }}

                        </h3>


                        <p class="text-sm text-slate-500">

                            Kode:
                            {{ $building->kode_bangunan }}

                        </p>


                    </div>


                </div>








                {{-- FORM --}}

                <form

                    action="{{ route('buildings.update',$building) }}"

                    method="POST"

                    class="p-6">


                    @csrf

                    @method('PUT')





                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">





                        {{-- KODE --}}

                        <div>


                            <label class="text-sm font-semibold text-slate-700">

                                Kode Bangunan

                            </label>


                            <input

                                type="text"

                                name="kode_bangunan"

                                value="{{ old('kode_bangunan',$building->kode_bangunan) }}"

                                class="
                                mt-2

                                w-full

                                rounded-xl

                                border-slate-200

                                focus:border-emerald-500

                                focus:ring-emerald-500
                                ">


                            @error('kode_bangunan')

                            <p class="text-red-500 text-xs mt-1">

                                {{ $message }}

                            </p>

                            @enderror


                        </div>








                        {{-- NAMA --}}

                        <div>


                            <label class="text-sm font-semibold text-slate-700">

                                Nama Bangunan

                            </label>


                            <input

                                type="text"

                                name="nama_bangunan"

                                value="{{ old('nama_bangunan',$building->nama_bangunan) }}"

                                class="
                                mt-2

                                w-full

                                rounded-xl

                                border-slate-200

                                focus:border-emerald-500

                                focus:ring-emerald-500
                                ">


                            @error('nama_bangunan')

                            <p class="text-red-500 text-xs mt-1">

                                {{ $message }}

                            </p>

                            @enderror


                        </div>








                        {{-- JENIS BANGUNAN --}}

                        <div>


                            <label class="text-sm font-semibold text-slate-700">

                                Jenis Bangunan

                            </label>


                            <select

                                name="jenis_bangunan"

                                class="
                                mt-2

                                w-full

                                rounded-xl

                                border-slate-200

                                focus:border-emerald-500

                                focus:ring-emerald-500">


                                @foreach([
                                    'Asrama',
                                    'Madrasah',
                                    'Masjid',
                                    'Gedung Serbaguna',
                                    'Kantor'
                                ] as $jenis)


                                <option

                                    value="{{ $jenis }}"

                                    {{ old('jenis_bangunan',$building->jenis_bangunan)==$jenis?'selected':'' }}>

                                    {{ $jenis }}

                                </option>


                                @endforeach


                            </select>


                        </div>









                        {{-- KONSTRUKSI --}}

                        <div>


                            <label class="text-sm font-semibold text-slate-700">

                                Jenis Konstruksi

                            </label>


                            <select

                                name="jenis_konstruksi"

                                class="
                                mt-2

                                w-full

                                rounded-xl

                                border-slate-200

                                focus:border-emerald-500

                                focus:ring-emerald-500">


                                @foreach([
                                    'Gedek',
                                    'Semi Permanen',
                                    'Permanen',
                                    'Permanen Bertingkat'
                                ] as $konstruksi)


                                <option

                                    value="{{ $konstruksi }}"

                                    {{ old('jenis_konstruksi',$building->jenis_konstruksi)==$konstruksi?'selected':'' }}>


                                    {{ $konstruksi }}


                                </option>


                                @endforeach


                            </select>


                        </div>









                        {{-- RAYON --}}

                        <div>


                            <label class="text-sm font-semibold text-slate-700">

                                Rayon

                            </label>


                            <input

                                type="text"

                                name="rayon"

                                value="{{ old('rayon',$building->rayon) }}"

                                class="
                                mt-2

                                w-full

                                rounded-xl

                                border-slate-200

                                focus:border-emerald-500

                                focus:ring-emerald-500">


                        </div>








                        {{-- TAHUN --}}

                        <div>


                            <label class="text-sm font-semibold text-slate-700">

                                Tahun Berdiri

                            </label>


                            <input

                                type="number"

                                name="tahun_berdiri"

                                value="{{ old('tahun_berdiri',$building->tahun_berdiri) }}"

                                class="
                                mt-2

                                w-full

                                rounded-xl

                                border-slate-200

                                focus:border-emerald-500

                                focus:ring-emerald-500">


                        </div>









                        {{-- LUAS --}}

                        <div>


                            <label class="text-sm font-semibold text-slate-700">

                                Luas Bangunan (m²)

                            </label>


                            <input

                                type="number"

                                step="0.01"

                                name="luas_bangunan"

                                value="{{ old('luas_bangunan',$building->luas_bangunan) }}"

                                class="
                                mt-2

                                w-full

                                rounded-xl

                                border-slate-200

                                focus:border-emerald-500

                                focus:ring-emerald-500">


                        </div>









                        {{-- ALAMAT --}}

                        <div class="md:col-span-2">


                            <label class="text-sm font-semibold text-slate-700">

                                Alamat Lengkap

                            </label>


                            <textarea

                                name="alamat"

                                rows="4"

                                class="
                                mt-2

                                w-full

                                rounded-xl

                                border-slate-200

                                focus:border-emerald-500

                                focus:ring-emerald-500">{{ old('alamat',$building->alamat) }}</textarea>


                        </div>



                    </div>








                    {{-- ACTION --}}

                    <div

                        class="
                        mt-8

                        pt-5

                        border-t

                        border-slate-100

                        flex

                        justify-end

                        gap-3
                        ">


                        <a

                            href="{{ route('buildings.index') }}"

                            class="
                            inline-flex
                            items-center
                            gap-2

                            px-5
                            py-3

                            rounded-xl

                            bg-slate-100

                            text-slate-700

                            font-semibold

                            hover:bg-slate-200

                            transition
                            ">


                            Batal


                        </a>





                        <button

                            type="submit"

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



                            <svg

                                class="w-5 h-5"

                                fill="none"

                                stroke="currentColor"

                                viewBox="0 0 24 24">


                                <path

                                    stroke-width="2"

                                    stroke-linecap="round"

                                    stroke-linejoin="round"

                                    d="M5 13l4 4L19 7"/>


                            </svg>



                            Simpan Perubahan


                        </button>



                    </div>





                </form>



            </div>



        </div>



    </div>



</x-app-layout>