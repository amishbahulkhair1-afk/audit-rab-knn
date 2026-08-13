<x-app-layout>

    <div class="space-y-6">


        {{-- HEADER --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">

            <div
                class="flex flex-col md:flex-row 
                    justify-between items-start md:items-center gap-4">

                <div>
                    <h1 class="text-xl font-bold text-slate-800">
                        Tambah Audit Kondisi Bangunan
                    </h1>

                    <p class="text-sm text-slate-500 mt-1">
                        Input hasil pemeriksaan kondisi bangunan untuk proses klasifikasi KNN.
                    </p>
                </div>


                <a href="{{ route('audits.index') }}"
                    class="inline-flex items-center gap-2
                      bg-slate-100 hover:bg-slate-200
                      text-slate-700
                      px-4 py-2
                      rounded-xl
                      text-sm font-medium
                      transition">

                    ← Kembali

                </a>

            </div>

        </div>





        {{-- ERROR ALERT --}}
        @if ($errors->any())
            <div
                class="bg-rose-50 border border-rose-200
                    text-rose-700
                    rounded-xl p-5 shadow-sm">

                <div class="flex items-center gap-2 mb-3">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />

                    </svg>


                    <span class="font-semibold">
                        Periksa kembali data:
                    </span>

                </div>


                <ul class="list-disc ml-6 text-sm space-y-1">

                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach

                </ul>


            </div>
        @endif






        {{-- FORM CARD --}}

        <div class="bg-white rounded-2xl shadow-sm
                border border-slate-100">


            <form action="{{ route('audits.store') }}" method="POST" class="p-6 md:p-8">


                @csrf




                {{-- DATA UTAMA --}}

                <div>

                    <h2 class="text-lg font-bold text-slate-800 mb-5">

                        Informasi Audit

                    </h2>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        {{-- tanggal --}}

                        <div>

                            <label class="text-sm font-semibold text-slate-700">
                                Tanggal Audit
                            </label>


                            <input type="date" name="tanggal_audit" value="{{ old('tanggal_audit', date('Y-m-d')) }}"
                                class="mt-2 w-full rounded-xl
                                      border-slate-300
                                      focus:ring-blue-500
                                      focus:border-blue-500">


                        </div>





                        {{-- bangunan --}}

                        <div>

                            <label class="text-sm font-semibold text-slate-700">
                                Pilih Bangunan
                            </label>


                            <select name="building_id"
                                class="mt-2 w-full rounded-xl
                                       border-slate-300
                                       focus:ring-blue-500
                                       focus:border-blue-500">


                                <option value="">
                                    -- Pilih Bangunan --
                                </option>


                                @foreach ($buildings as $building)
                                    <option value="{{ $building->id }}">

                                        [{{ $building->kode_bangunan }}]
                                        {{ $building->nama_bangunan }}

                                    </option>
                                @endforeach


                            </select>

                        </div>


                    </div>


                </div>






                {{-- PEMBATAS --}}

                <div class="my-8 border-t"></div>





                {{-- KOMPONEN --}}

                <h2 class="text-lg font-bold text-slate-800 mb-5">

                    Penilaian Kondisi Komponen Bangunan

                </h2>





                @php

                    $komponen = [
                        'pondasi' => 'Pondasi',

                        'struktur' => 'Struktur Kolom/Balok',

                        'atap' => 'Atap & Rangka',

                        'dinding' => 'Dinding & Partisi',

                        'lantai' => 'Lantai / Keramik',

                        'plafon' => 'Plafon',

                        'pintu' => 'Pintu & Kusen',

                        'jendela' => 'Jendela & Kaca',

                        'listrik' => 'Elektrikal',

                        'sanitasi' => 'Sanitasi & Plumbing',
                    ];

                @endphp






                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                    @foreach ($komponen as $field => $label)
                        <div
                            class="bg-slate-50
                            rounded-xl
                            border border-slate-100
                            p-4">


                            <label
                                class="block text-sm
                                  font-semibold
                                  text-slate-700 mb-2">


                                {{ $label }}


                            </label>



                            <select name="{{ $field }}"
                                class="w-full rounded-lg
                                   border-slate-300">


                                <option value="">
                                    Pilih Kondisi
                                </option>


                                <option value="5">
                                    5 - Sangat Baik
                                </option>

                                <option value="4">
                                    4 - Baik
                                </option>


                                <option value="3">
                                    3 - Rusak Ringan
                                </option>


                                <option value="2">
                                    2 - Rusak Sedang
                                </option>


                                <option value="1">
                                    1 - Rusak Berat
                                </option>


                            </select>


                        </div>
                    @endforeach


                </div>







                {{-- CATATAN --}}

                <div class="mt-6">


                    <label class="text-sm font-semibold text-slate-700">

                        Catatan Lapangan

                    </label>


                    <textarea name="catatan" rows="4" class="mt-2 w-full rounded-xl
                                 border-slate-300"
                        placeholder="Masukkan catatan pemeriksaan...">{{ old('catatan') }}</textarea>


                </div>








                {{-- BUTTON --}}

                <div class="mt-8 pt-5 border-t
                        flex justify-end gap-3">


                    <a href="{{ route('audits.index') }}"
                        class="px-5 py-2
                          bg-slate-100
                          hover:bg-slate-200
                          rounded-xl
                          text-sm">

                        Batal

                    </a>



                    <button type="submit"
                        class="px-6 py-2
                               bg-blue-600
                               hover:bg-blue-700
                               text-white
                               rounded-xl
                               text-sm
                               font-semibold">

                        Simpan Audit

                    </button>


                </div>



            </form>


        </div>


    </div>

</x-app-layout>
