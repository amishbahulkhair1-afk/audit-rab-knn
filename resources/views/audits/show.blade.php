<x-app-layout>

    <x-slot name="header">

        <div class="w-full flex justify-between items-center">

            {{-- Judul kiri --}}
            <div>
                <h2 class="font-bold text-xl text-slate-800">
                    Detail Audit Bangunan
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Informasi pemeriksaan dan hasil klasifikasi bangunan
                </p>
            </div>


            {{-- Tombol kanan --}}
            <div class="flex items-center gap-3">

                <a href="{{ route('audits.index') }}"
                    class="
                inline-flex
                items-center
                gap-2

                bg-slate-100
                hover:bg-slate-200

                text-slate-700

                px-4
                py-2

                rounded-xl

                text-sm
                font-semibold

                transition
                ">


                    {{-- Heroicon Arrow Left --}}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />

                    </svg>


                    Kembali

                </a>

            </div>


        </div>

    </x-slot>



    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="
bg-white
rounded-2xl
shadow-sm
border
border-slate-100
overflow-hidden
">


                {{-- ===========================
HEADER CARD
=========================== --}}


                <div class="
bg-gradient-to-r
from-emerald-600
to-emerald-500

px-6
py-5

text-white

">


                    <div class="flex justify-between items-center">


                        <div>

                            <h3 class="text-xl font-bold">

                                {{ $audit->building->nama_bangunan }}

                            </h3>


                            <p class="text-emerald-100 text-sm mt-1">

                                Nomor Audit :
                                {{ $audit->nomor_audit }}

                            </p>


                        </div>



                        <div>

                            @if ($audit->hasil_knn)
                                <span
                                    class="
px-4
py-2

rounded-full

bg-white/20

text-white

text-sm

font-bold

backdrop-blur
">

                                    {{ $audit->hasil_knn }}

                                </span>
                            @else
                                <span class="
px-4
py-2

rounded-full

bg-white/20

text-white

text-sm

font-bold
">

                                    Belum Diproses

                                </span>
                            @endif


                        </div>



                    </div>


                </div>





                {{-- ===========================
INFORMASI UTAMA
=========================== --}}


                <div class="p-6">


                    <h3 class="
text-lg
font-bold
text-slate-800
mb-5
">

                        Informasi Utama Audit

                    </h3>



                    <div class="
grid
grid-cols-1
md:grid-cols-2
gap-6
">


                        <div>

                            <p class="
text-xs
uppercase
font-bold
text-slate-400
">

                                Tanggal Audit

                            </p>


                            <p class="mt-1 font-semibold text-slate-700">

                                {{ \Carbon\Carbon::parse($audit->tanggal_audit)->translatedFormat('d F Y') }}

                            </p>


                        </div>





                        <div>

                            <p class="
text-xs
uppercase
font-bold
text-slate-400
">

                                Jenis Konstruksi

                            </p>


                            <p class="mt-1 font-semibold text-slate-700">

                                {{ $audit->building->jenis_konstruksi }}

                            </p>


                        </div>





                        <div>

                            <p class="
text-xs
uppercase
font-bold
text-slate-400
">

                                Auditor Lapangan

                            </p>


                            <p class="mt-1 font-semibold text-slate-700">

                                {{ $audit->user->name }}

                            </p>


                        </div>





                        <div>

                            <p class="
text-xs
uppercase
font-bold
text-slate-400
">

                                Rayon

                            </p>


                            <p class="mt-1 font-semibold text-slate-700">

                                {{ $audit->building->rayon }}

                            </p>


                        </div>


                    </div>



                </div>

                {{-- =====================================================
ANALISIS KNN
===================================================== --}}

                <div class="
border-t
border-slate-100
px-6
py-6
">


                    <div class="flex items-center gap-3 mb-5">


                        <div
                            class="
w-10
h-10

rounded-xl

bg-blue-50

text-blue-600

flex
items-center
justify-center
">


                            <!-- Heroicon Chart -->

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />

                            </svg>


                        </div>



                        <div>

                            <h3 class="
text-lg
font-bold
text-slate-800
">

                                Analisis Klasifikasi Tetangga Terdekat (K=3)

                            </h3>


                            <p class="text-sm text-slate-500">

                                Perhitungan jarak Euclidean terhadap data training

                            </p>


                        </div>


                    </div>





                    <div class="
overflow-x-auto

rounded-xl

border
border-slate-100
">


                        <table class="w-full text-sm">


                            <thead class="bg-slate-50">


                                <tr class="text-left text-slate-500">


                                    <th class="px-5 py-4 font-semibold">
                                        No
                                    </th>


                                    <th class="px-5 py-4 font-semibold">
                                        Kode Data
                                    </th>


                                    <th class="px-5 py-4 font-semibold">
                                        Jenis Konstruksi
                                    </th>


                                    <th class="px-5 py-4 font-semibold">
                                        Kategori
                                    </th>


                                    <th class="px-5 py-4 font-semibold text-right">
                                        Jarak Euclidean
                                    </th>


                                </tr>


                            </thead>




                            <tbody class="divide-y divide-slate-100">


                                @forelse($audit->knnResults as $result)
                                    <tr class="
hover:bg-slate-50
transition
">


                                        <td class="px-5 py-4 text-slate-400">

                                            {{ $loop->iteration }}

                                        </td>




                                        <td class="
px-5
py-4

font-mono
font-semibold
text-slate-700
">


                                            {{ $result->dataSet->kode_data }}


                                        </td>





                                        <td class="px-5 py-4">

                                            {{ $result->dataSet->jenis_konstruksi }}

                                        </td>





                                        <td class="px-5 py-4">


                                            @php

                                                $kategori = strtolower($result->dataSet->kategori);

                                            @endphp



                                            @if (str_contains($kategori, 'layak'))
                                                <span
                                                    class="
px-3
py-1

rounded-full

text-xs

font-bold

bg-emerald-100

text-emerald-700
">

                                                    {{ $result->dataSet->kategori }}

                                                </span>
                                            @elseif(str_contains($kategori, 'kurang'))
                                                <span
                                                    class="
px-3
py-1

rounded-full

text-xs

font-bold

bg-amber-100

text-amber-700
">

                                                    {{ $result->dataSet->kategori }}

                                                </span>
                                            @else
                                                <span
                                                    class="
px-3
py-1

rounded-full

text-xs

font-bold

bg-red-100

text-red-700
">

                                                    {{ $result->dataSet->kategori }}

                                                </span>
                                            @endif


                                        </td>






                                        <td class="
px-5
py-4

text-right

font-mono

font-semibold
">


                                            {{ number_format($result->distance, 4) }}


                                        </td>



                                    </tr>


                                @empty


                                    <tr>

                                        <td colspan="5" class="
text-center
py-8
text-slate-400
">


                                            Data KNN belum tersedia.


                                        </td>


                                    </tr>
                                @endforelse


                            </tbody>


                        </table>


                    </div>


                </div>









                {{-- =====================================================
SKOR KOMPONEN BANGUNAN
===================================================== --}}


                <div class="
border-t
border-slate-100

px-6
py-6
">


                    <div class="flex items-center gap-3 mb-5">


                        <div
                            class="
w-10
h-10

rounded-xl

bg-amber-50

text-amber-600

flex
items-center
justify-center
">


                            <!-- Heroicon Clipboard -->

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">


                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />


                            </svg>


                        </div>



                        <div>

                            <h3 class="
text-lg
font-bold
text-slate-800
">

                                Skor Penilaian Komponen Elemen Bangunan

                            </h3>


                            <p class="text-sm text-slate-500">

                                Nilai kondisi setiap elemen bangunan

                            </p>


                        </div>


                    </div>






                    <div class="
overflow-x-auto

rounded-xl

border
border-slate-100
">


                        <table class="w-full text-sm">


                            <thead class="bg-slate-50">


                                <tr class="text-left text-slate-500">


                                    <th class="px-5 py-4">
                                        No
                                    </th>


                                    <th class="px-5 py-4">
                                        Komponen Elemen
                                    </th>


                                    <th class="px-5 py-4 text-center">
                                        Nilai
                                    </th>


                                </tr>


                            </thead>



                            <tbody class="divide-y divide-slate-100">


                                @forelse($audit->details as $detail)
                                    <tr class="hover:bg-slate-50 transition">


                                        <td class="px-5 py-4 text-slate-400">

                                            {{ $loop->iteration }}

                                        </td>



                                        <td class="px-5 py-4 font-medium text-slate-700">

                                            {{ ucfirst($detail->komponen) }}

                                        </td>




                                        <td class="px-5 py-4 text-center">


                                            <span
                                                class="
inline-flex
items-center
justify-center

w-10
h-10

rounded-xl

bg-emerald-50

text-emerald-700

font-bold
">

                                                {{ $detail->nilai }}


                                            </span>


                                        </td>



                                    </tr>



                                @empty


                                    <tr>

                                        <td colspan="3" class="
text-center
py-8
text-slate-400
">

                                            Belum ada nilai komponen.


                                        </td>


                                    </tr>
                                @endforelse


                            </tbody>


                        </table>


                    </div>



                </div>

                {{-- =====================================================
RAB PEMULIHAN
===================================================== --}}

                @if ($audit->rab)


                    <div class="
border-t
border-slate-100

px-6
py-6
">


                        <div class="
flex
justify-between
items-center

mb-5
">


                            <div class="flex items-center gap-3">


                                <div
                                    class="
w-10
h-10

rounded-xl

bg-emerald-50

text-emerald-600

flex
items-center
justify-center
">


                                    <!-- Heroicon Currency -->

                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">


                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />


                                    </svg>


                                </div>




                                <div>

                                    <h3 class="
text-lg
font-bold
text-slate-800
">

                                        Rencana Anggaran Biaya (RAB)

                                    </h3>


                                    <p class="text-sm text-slate-500">

                                        Estimasi biaya pemulihan bangunan

                                    </p>


                                </div>


                            </div>






                            <button onclick="document.getElementById('modalPekerjaan').classList.remove('hidden')"
                                class="
inline-flex
items-center
gap-2

bg-emerald-600
hover:bg-emerald-700

text-white

px-4
py-2

rounded-xl

text-sm
font-semibold

shadow-sm

transition
">


                                <!-- Heroicon Plus -->

                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">


                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />


                                </svg>


                                Tambah Pekerjaan


                            </button>



                        </div>







                        <div class="
overflow-x-auto

rounded-xl

border
border-slate-100
">


                            <table class="w-full text-sm">


                                <thead class="bg-slate-50">


                                    <tr class="text-left text-slate-500">


                                        <th class="px-5 py-4">
                                            No
                                        </th>


                                        <th class="px-5 py-4">
                                            Uraian Pekerjaan
                                        </th>


                                        <th class="px-5 py-4 text-center">
                                            Volume
                                        </th>


                                        <th class="px-5 py-4 text-right">
                                            Harga Satuan
                                        </th>


                                        <th class="px-5 py-4 text-right">
                                            Subtotal
                                        </th>


                                    </tr>


                                </thead>




                                <tbody class="divide-y divide-slate-100">


                                    @forelse($audit->rab->details as $detail)
                                        <tr class="
hover:bg-slate-50
transition
">


                                            <td class="px-5 py-4 text-slate-400">

                                                {{ $loop->iteration }}

                                            </td>




                                            <td class="px-5 py-4 font-medium text-slate-700">

                                                {{ $detail->ahsp->nama_pekerjaan }}

                                            </td>




                                            <td class="px-5 py-4 text-center">

                                                {{ $detail->volume }}

                                            </td>




                                            <td class="
px-5
py-4
text-right
font-mono
">


                                                Rp
                                                {{ number_format($detail->harga_satuan, 0, ',', '.') }}


                                            </td>




                                            <td
                                                class="
px-5
py-4

text-right

font-bold

text-emerald-600

font-mono
">


                                                Rp
                                                {{ number_format($detail->subtotal, 0, ',', '.') }}


                                            </td>


                                        </tr>


                                    @empty


                                        <tr>

                                            <td colspan="5" class="
text-center
py-10
text-slate-400
">


                                                Belum ada pekerjaan RAB.


                                            </td>


                                        </tr>
                                    @endforelse


                                </tbody>





                                @if ($audit->rab->details->isNotEmpty())
                                    <tfoot class="bg-slate-50">


                                        <tr>


                                            <td colspan="4"
                                                class="
px-5
py-4

text-right

font-bold

text-slate-700
">


                                                TOTAL ESTIMASI BIAYA


                                            </td>



                                            <td
                                                class="
px-5
py-4

text-right

font-bold

text-lg

text-emerald-700

font-mono
">


                                                Rp
                                                {{ number_format($audit->rab->total_biaya, 0, ',', '.') }}


                                            </td>



                                        </tr>


                                    </tfoot>
                                @endif



                            </table>



                        </div>



                    </div>


                @endif







                {{-- =====================================================
ACTION BUTTON
===================================================== --}}


                <div class="
border-t
border-slate-100

px-6
py-5

flex
justify-end

gap-3
">


                    <a href="{{ route('audits.index') }}"
                        class="
inline-flex
items-center
gap-2

bg-slate-100

hover:bg-slate-200

text-slate-700

px-4
py-2

rounded-xl

text-sm
font-semibold
">


                        Kembali

                    </a>





                    <a href="{{ route('audits.pdf', $audit->id) }}"
                        class="
inline-flex
items-center
gap-2

bg-red-600

hover:bg-red-700

text-white

px-4
py-2

rounded-xl

text-sm
font-semibold
">


                        Cetak PDF


                    </a>





                    @if (!$audit->rab)
                        <form action="{{ route('rabs.create-from-audit', $audit->id) }}" method="POST">

                            @csrf


                            <button
                                class="
bg-emerald-600

hover:bg-emerald-700

text-white

px-4
py-2

rounded-xl

text-sm

font-semibold
">

                                Buat Formulir RAB

                            </button>


                        </form>
                    @endif



                </div>
                @if ($audit->rab)

                    <div id="modalPekerjaan"
                        class="hidden fixed inset-0 z-50 
            bg-black/50 
            flex items-center justify-center">


                        <div class="bg-white rounded-2xl shadow-xl 
                w-full max-w-lg mx-4 p-6">


                            {{-- HEADER MODAL --}}

                            <div class="flex justify-between items-center mb-5">


                                <h3 class="text-lg font-bold text-gray-800">
                                    Tambah Item Pekerjaan RAB
                                </h3>


                                <button onclick="document.getElementById('modalPekerjaan').classList.add('hidden')"
                                    class="text-gray-400 hover:text-red-500 text-2xl">

                                    &times;

                                </button>


                            </div>





                            {{-- FORM --}}

                            <form action="{{ route('rab-details.store') }}" method="POST">


                                @csrf


                                <input type="hidden" name="rab_id" value="{{ $audit->rab->id }}">





                                {{-- PILIH AHSP --}}

                                <div class="mb-4">


                                    <label class="block text-sm font-semibold mb-2">
                                        Pilih Pekerjaan AHSP
                                    </label>


                                    <select name="ahsp_id" class="w-full rounded-lg border-gray-300" required>


                                        <option value="">
                                            -- Pilih Pekerjaan --
                                        </option>


                                        @foreach ($ahsps as $ahsp)
                                            <option value="{{ $ahsp->id }}">

                                                {{ $ahsp->kode }}
                                                -
                                                {{ $ahsp->nama_pekerjaan }}

                                            </option>
                                        @endforeach


                                    </select>


                                </div>





                                {{-- VOLUME --}}

                                <div class="mb-5">


                                    <label class="block text-sm font-semibold mb-2">

                                        Volume

                                    </label>


                                    <input type="number" step="0.01" min="0" name="volume"
                                        class="w-full rounded-lg border-gray-300" placeholder="Contoh: 10.5" required>


                                </div>





                                {{-- BUTTON --}}

                                <div class="flex justify-end gap-3">


                                    <button type="button"
                                        onclick="document.getElementById('modalPekerjaan').classList.add('hidden')"
                                        class="px-4 py-2 bg-gray-100 rounded-lg">

                                        Batal

                                    </button>


                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">

                                        Simpan

                                    </button>


                                </div>



                            </form>


                        </div>


                    </div>

                @endif
</x-app-layout>
