<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between w-full">

            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Detail Data Material </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Manajemen data material pendukung pekerjaan
                </p>
            </div>

            <a href="{{ route('materials.index') }}"
                class="inline-flex items-center px-4 py-2.5
                       bg-slate-100 hover:bg-slate-200
                       text-slate-700 rounded-xl shadow-sm transition">

                Kembali
            </a>

        </div>
    </x-slot>





    <div class="py-10">


        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">





            <div
                class="
                bg-white
                shadow-sm
                rounded-xl
                border
                border-slate-100
                overflow-hidden
            ">





                <!-- HEADER CARD -->


                <div
                    class="
                    px-6
                    py-5
                    bg-slate-50
                    border-b
                    border-slate-100
                    flex
                    justify-between
                    items-center
                ">



                    <div>


                        <h3
                            class="
                            text-lg
                            font-bold
                            text-slate-800
                        ">

                            {{ $material->nama_bahan }}

                        </h3>




                        <p
                            class="
                            text-sm
                            text-slate-500
                            mt-1
                        ">

                            Detail informasi material pembangunan

                        </p>



                    </div>







                    <span
                        class="
                        px-3
                        py-1.5
                        text-xs
                        font-semibold
                        rounded-lg
                        bg-indigo-50
                        text-indigo-700
                        border
                        border-indigo-100
                    ">


                        Kode : {{ $material->kode ?? '-' }}


                    </span>



                </div>









                <!-- DETAIL CONTENT -->


                <div class="p-6">



                    <div
                        class="
                        grid
                        grid-cols-1
                        md:grid-cols-2
                        gap-5
                    ">







                        <!-- ID -->


                        <div
                            class="
                            bg-slate-50
                            rounded-xl
                            border
                            border-slate-100
                            p-5
                        ">


                            <p
                                class="
                                text-xs
                                font-bold
                                text-slate-400
                                uppercase
                                tracking-wide
                            ">

                                ID Material

                            </p>




                            <p
                                class="
                                mt-2
                                text-base
                                font-semibold
                                text-slate-800
                            ">

                                #{{ $material->id }}

                            </p>


                        </div>









                        <!-- Nama -->


                        <div
                            class="
                            bg-slate-50
                            rounded-xl
                            border
                            border-slate-100
                            p-5
                        ">


                            <p
                                class="
                                text-xs
                                font-bold
                                text-slate-400
                                uppercase
                                tracking-wide
                            ">

                                Nama Bahan

                            </p>





                            <p
                                class="
                                mt-2
                                text-base
                                font-semibold
                                text-slate-800
                            ">

                                {{ $material->nama_bahan }}

                            </p>


                        </div>









                        <!-- Satuan -->


                        <div
                            class="
                            bg-slate-50
                            rounded-xl
                            border
                            border-slate-100
                            p-5
                        ">


                            <p
                                class="
                                text-xs
                                font-bold
                                text-slate-400
                                uppercase
                                tracking-wide
                            ">

                                Satuan

                            </p>





                            <span
                                class="
                                inline-flex
                                mt-2
                                px-3
                                py-1
                                text-xs
                                font-semibold
                                bg-white
                                border
                                border-slate-200
                                rounded-lg
                                text-slate-700
                            ">

                                {{ $material->satuan }}

                            </span>


                        </div>









                        <!-- Harga -->


                        <div
                            class="
                            bg-slate-50
                            rounded-xl
                            border
                            border-slate-100
                            p-5
                        ">



                            <p
                                class="
                                text-xs
                                font-bold
                                text-slate-400
                                uppercase
                                tracking-wide
                            ">

                                Harga Satuan

                            </p>





                            <p
                                class="
                                mt-2
                                text-lg
                                font-bold
                                text-indigo-600
                            ">


                                Rp {{ number_format($material->harga_satuan, 0, ',', '.') }}


                            </p>


                        </div>









                        <!-- Keterangan -->


                        <div
                            class="
                            md:col-span-2
                            bg-slate-50
                            rounded-xl
                            border
                            border-slate-100
                            p-5
                        ">



                            <p
                                class="
                                text-xs
                                font-bold
                                text-slate-400
                                uppercase
                                tracking-wide
                            ">

                                Keterangan

                            </p>





                            <p
                                class="
                                mt-2
                                text-sm
                                text-slate-700
                                leading-relaxed
                            ">


                                {{ $material->keterangan ?? 'Tidak ada keterangan tambahan.' }}


                            </p>



                        </div>





                    </div>



                </div>









                <!-- FOOTER ACTION -->


                <div
                    class="
                    px-6
                    py-4
                    bg-slate-50
                    border-t
                    border-slate-100
                    flex
                    justify-end
                    gap-3
                ">




                    <a href="{{ route('materials.edit', $material->id) }}"
                        class="
                        px-4
                        py-2
                        bg-amber-500
                        hover:bg-amber-600
                        text-white
                        text-sm
                        font-semibold
                        rounded-lg
                        shadow-sm
                        transition
                        ">

                        Edit Data

                    </a>







                    <form action="{{ route('materials.destroy', $material->id) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus material ini?')">

                        @csrf

                        @method('DELETE')




                        <button type="submit"
                            class="
                            px-4
                            py-2
                            bg-rose-500
                            hover:bg-rose-600
                            text-white
                            text-sm
                            font-semibold
                            rounded-lg
                            shadow-sm
                            transition
                            ">

                            Hapus

                        </button>



                    </form>





                </div>






            </div>




        </div>


    </div>



</x-app-layout>
