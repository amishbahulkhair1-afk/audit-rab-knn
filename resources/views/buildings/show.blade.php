<x-app-layout>

    <x-slot name="header">

        <div class="w-full flex flex-col md:flex-row md:items-center md:justify-between gap-4">


            {{-- TITLE --}}

            <div>

                <h2 class="font-bold text-2xl text-slate-900">

                    Detail Informasi Bangunan

                </h2>


                <p class="text-sm text-slate-500 mt-1">

                    Informasi lengkap mengenai data bangunan.

                </p>


            </div>





            {{-- EDIT BUTTON --}}

            <a href="{{ route('buildings.edit', $building) }}"

                class="
                inline-flex
                items-center
                gap-2

                bg-gradient-to-r
                from-amber-500
                to-amber-400

                hover:from-amber-600
                hover:to-amber-500

                text-white

                px-5
                py-3

                rounded-xl

                font-semibold

                shadow-md

                hover:shadow-lg

                transition
                ">


                {{-- Edit Icon --}}

                <svg
                    class="w-5 h-5"

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



                Edit Data


            </a>



        </div>


    </x-slot>






    <div class="py-8">


        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">



            {{-- MAIN CARD --}}

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
                    py-6

                    bg-slate-50

                    border-b
                    border-slate-100

                    flex
                    items-center
                    justify-between
                    gap-4
                    ">



                    <div>


                        <h3 class="text-xl font-bold text-slate-900">


                            {{ $building->nama_bangunan }}


                        </h3>



                        <div class="flex items-center gap-2 mt-2">


                            <span class="text-xs text-slate-500">

                                Kode:

                            </span>


                            <span

                                class="
                                font-mono
                                text-sm
                                font-semibold
                                text-slate-700
                                ">

                                {{ $building->kode_bangunan }}

                            </span>


                        </div>


                    </div>





                    {{-- Rayon Badge --}}

                    <span

                        class="
                        px-4
                        py-2

                        rounded-full

                        bg-emerald-50

                        text-emerald-700

                        text-xs

                        font-bold
                        ">


                        {{ $building->rayon }}


                    </span>



                </div>








                {{-- DETAIL CONTENT --}}


                <div class="p-6">


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">





                        {{-- JENIS BANGUNAN --}}

                        <div>

                            <p class="text-xs uppercase font-bold text-slate-400">

                                Jenis Bangunan

                            </p>


                            <p class="mt-2 font-semibold text-slate-800">

                                {{ $building->jenis_bangunan ?? '-' }}

                            </p>


                        </div>







                        {{-- KONSTRUKSI --}}

                        <div>

                            <p class="text-xs uppercase font-bold text-slate-400">

                                Jenis Konstruksi

                            </p>


                            <p class="mt-2 font-semibold text-slate-800">

                                {{ $building->jenis_konstruksi ?? '-' }}

                            </p>


                        </div>






                        {{-- TAHUN --}}

                        <div>


                            <p class="text-xs uppercase font-bold text-slate-400">

                                Tahun Berdiri

                            </p>


                            <p class="mt-2 font-semibold text-slate-800">

                                {{ $building->tahun_berdiri ?? '-' }}

                            </p>


                        </div>






                        {{-- LUAS --}}

                        <div>


                            <p class="text-xs uppercase font-bold text-slate-400">

                                Luas Bangunan

                            </p>


                            <p class="mt-2 text-lg font-bold text-emerald-600">

                                {{ $building->luas_bangunan }}

                                m²

                            </p>


                        </div>








                        {{-- ALAMAT --}}

                        <div class="md:col-span-2">


                            <div

                                class="
                                mt-2

                                p-5

                                rounded-2xl

                                bg-slate-50

                                border
                                border-slate-100
                                ">


                                <p class="text-xs uppercase font-bold text-slate-400">

                                    Alamat Lengkap

                                </p>


                                <p class="mt-3 text-slate-700 leading-relaxed">


                                    {{ $building->alamat ?? '-' }}


                                </p>



                            </div>


                        </div>




                    </div>


                </div>








                {{-- FOOTER --}}

                <div

                    class="
                    px-6
                    py-5

                    bg-slate-50

                    border-t
                    border-slate-100
                    ">



                    <a href="{{ route('buildings.index') }}"

                        class="
                        inline-flex
                        items-center
                        gap-2

                        bg-white

                        hover:bg-slate-100

                        text-slate-700

                        px-5

                        py-2.5

                        rounded-xl

                        border
                        border-slate-200

                        shadow-sm

                        font-semibold

                        text-sm

                        transition
                        ">


                        {{-- Arrow Icon --}}

                        <svg
                            class="w-4 h-4"

                            fill="none"

                            stroke="currentColor"

                            viewBox="0 0 24 24">


                            <path

                                stroke-width="2"

                                stroke-linecap="round"

                                stroke-linejoin="round"

                                d="M15 19l-7-7 7-7"

                            />


                        </svg>



                        Kembali


                    </a>



                </div>




            </div>




        </div>


    </div>



</x-app-layout>