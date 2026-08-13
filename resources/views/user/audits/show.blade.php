@extends('layouts.user')

@section('content')

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6 space-y-8">

            {{-- =========================================================
            HEADER
        ========================================================== --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <p class="text-sm text-slate-500">
                        Dashboard /
                        Audit /
                        Detail
                    </p>

                    <h1 class="text-3xl font-bold text-slate-800 mt-1">
                        Detail Audit Bangunan
                    </h1>

                    <p class="text-slate-500 mt-2">
                        Informasi lengkap audit bangunan, hasil klasifikasi KNN,
                        serta estimasi RAB.
                    </p>
                </div>

                <div class="flex gap-3">

                    <a href="{{ route('audits.index') }}"
                        class="px-5 py-2.5 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 font-semibold">

                        Kembali

                    </a>

                    <a href="{{ route('audits.pdf', $audit->id) }}" target="_blank"
                        class="px-5 py-2.5 rounded-xl bg-red-600 text-white hover:bg-red-700">

                        Unduh Laporan

                    </a>

                </div>

            </div>

            {{-- =========================================================
            SUMMARY
        ========================================================== --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

                {{-- Nomor Audit --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

                    <p class="text-xs uppercase tracking-widest text-slate-400">
                        Nomor Audit
                    </p>

                    <h2 class="text-xl font-bold mt-3">
                        {{ $audit->nomor_audit }}
                    </h2>

                </div>

                {{-- Auditor --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

                    <p class="text-xs uppercase tracking-widest text-slate-400">
                        Auditor
                    </p>

                    <h2 class="text-xl font-bold mt-3">

                        {{ $audit->user->name }}

                    </h2>

                </div>

                {{-- Hasil --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

                    <p class="text-xs uppercase tracking-widest text-slate-400">
                        Hasil KNN
                    </p>

                    @if ($audit->hasil_knn)
                        @php
                            $layak = str_contains(strtolower($audit->hasil_knn), 'layak');
                        @endphp

                        <span
                            class="inline-flex mt-3 px-4 py-2 rounded-full text-sm font-bold
                        {{ $layak ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">

                            {{ $audit->hasil_knn }}

                        </span>
                    @else
                        <span class="inline-flex mt-3 px-4 py-2 rounded-full bg-yellow-100 text-yellow-700">

                            Belum Diproses

                        </span>
                    @endif

                </div>

                {{-- Total RAB --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

                    <p class="text-xs uppercase tracking-widest text-slate-400">
                        Total RAB
                    </p>

                    <h2 class="text-xl font-bold mt-3">

                        @if ($audit->rab)
                            Rp {{ number_format($audit->rab->total_biaya, 0, ',', '.') }}
                        @else
                            -
                        @endif

                    </h2>

                </div>

            </div>

            {{-- =========================================================
            INFORMASI AUDIT
        ========================================================== --}}

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">

                <h3 class="text-lg font-bold mb-8">

                    Informasi Audit

                </h3>

                <div class="grid md:grid-cols-2 gap-8">

                    <div>

                        <label class="text-xs uppercase text-slate-400">
                            Nomor Audit
                        </label>

                        <p class="font-semibold mt-1">
                            {{ $audit->nomor_audit }}
                        </p>

                    </div>

                    <div>

                        <label class="text-xs uppercase text-slate-400">
                            Tanggal Audit
                        </label>

                        <p class="font-semibold mt-1">
                            {{ \Carbon\Carbon::parse($audit->tanggal_audit)->format('d F Y') }}
                        </p>

                    </div>

                    <div>

                        <label class="text-xs uppercase text-slate-400">
                            Nama Bangunan
                        </label>

                        <p class="font-semibold mt-1">
                            {{ $audit->building->nama_bangunan }}
                        </p>

                    </div>

                    <div>

                        <label class="text-xs uppercase text-slate-400">
                            Jenis Konstruksi
                        </label>

                        <p class="font-semibold mt-1">
                            {{ $audit->building->jenis_konstruksi }}
                        </p>

                    </div>

                    <div>

                        <label class="text-xs uppercase text-slate-400">
                            Auditor
                        </label>

                        <p class="font-semibold mt-1">
                            {{ $audit->user->name }}
                        </p>

                    </div>

                </div>

            </div>

            {{-- =========================================================
            HASIL + KOMPONEN
        ========================================================== --}}

            <div class="grid lg:grid-cols-3 gap-6">

                {{-- HASIL --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

                    <h3 class="font-bold text-lg mb-5">
                        Hasil Klasifikasi
                    </h3>

                    @if ($audit->hasil_knn)
                        @php
                            $layak = str_contains(strtolower($audit->hasil_knn), 'layak');
                        @endphp

                        <div
                            class="rounded-xl p-6
                        {{ $layak ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200' }}">

                            <div class="text-3xl font-bold">

                                {{ $audit->hasil_knn }}

                            </div>

                            <p class="text-sm text-slate-500 mt-3">

                                Hasil klasifikasi menggunakan algoritma
                                K-Nearest Neighbor.

                            </p>

                        </div>
                    @else
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">

                            Belum dilakukan klasifikasi.

                        </div>
                    @endif

                </div>

                {{-- KOMPONEN --}}
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

                    <h3 class="font-bold text-lg mb-5">

                        Penilaian Komponen

                    </h3>

                    <div class="space-y-4">

                        @foreach ($audit->details as $detail)
                            <div>

                                <div class="flex justify-between mb-2">

                                    <span class="font-medium">

                                        {{ ucfirst($detail->komponen) }}

                                    </span>

                                    <span class="font-bold">

                                        {{ $detail->nilai }}

                                    </span>

                                </div>

                                <div class="w-full bg-slate-200 rounded-full h-3">

                                    <div class="h-3 rounded-full bg-blue-600" style="width:{{ $detail->nilai }}%">

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>

            </div>

            {{-- =========================================================
            TETANGGA TERDEKAT
        ========================================================== --}}

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">

                <div class="flex justify-between items-center mb-6">

                    <h3 class="text-xl font-bold">

                        Tetangga Terdekat (K = 3)

                    </h3>

                    <span class="text-sm text-slate-400">

                        Hasil Perhitungan KNN

                    </span>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="border-b">

                                <th class="text-left py-3">
                                    Kode
                                </th>

                                <th class="text-left py-3">
                                    Jenis
                                </th>

                                <th class="text-left py-3">
                                    Kategori
                                </th>

                                <th class="text-right py-3">
                                    Jarak
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($audit->knnResults as $result)
                                <tr class="border-b hover:bg-slate-50">

                                    <td class="py-4">
                                        {{ $result->dataSet->kode_data }}
                                    </td>

                                    <td>
                                        {{ $result->dataSet->jenis_konstruksi }}
                                    </td>

                                    <td>

                                        <span class="px-3 py-1 rounded-full bg-slate-100 text-sm">

                                            {{ $result->dataSet->kategori }}

                                        </span>

                                    </td>

                                    <td class="text-right font-semibold">

                                        {{ number_format($result->distance, 4) }}

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- =========================================================
    RENCANA ANGGARAN BIAYA
========================================================= --}}

            @if ($audit->rab)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">


                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">


                        <div>

                            <h3 class="text-xl font-bold text-slate-800">
                                Rencana Anggaran Biaya (RAB)
                            </h3>

                            <p class="text-sm text-slate-500 mt-1">
                                Detail estimasi biaya berdasarkan pekerjaan AHSP.
                            </p>

                        </div>


                        <button onclick="document.getElementById('modalPekerjaan').classList.remove('hidden')"
                            class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow">

                            + Tambah Pekerjaan

                        </button>


                    </div>



                    <div class="overflow-x-auto">

                        <table class="w-full text-sm">


                            <thead>

                                <tr class="border-b text-xs uppercase text-slate-400">


                                    <th class="text-left py-4">
                                        No
                                    </th>


                                    <th class="text-left py-4">
                                        Pekerjaan
                                    </th>


                                    <th class="text-center py-4">
                                        Volume
                                    </th>


                                    <th class="text-right py-4">
                                        Harga Satuan
                                    </th>


                                    <th class="text-right py-4">
                                        Subtotal
                                    </th>


                                </tr>


                            </thead>



                            <tbody class="divide-y">


                                @forelse($audit->rab->details as $detail)
                                    <tr class="hover:bg-slate-50">


                                        <td class="py-4">

                                            {{ $loop->iteration }}

                                        </td>



                                        <td class="py-4 font-medium">

                                            {{ $detail->ahsp->nama_pekerjaan }}

                                        </td>



                                        <td class="py-4 text-center">

                                            {{ $detail->volume }}

                                        </td>



                                        <td class="py-4 text-right">

                                            Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}

                                        </td>



                                        <td class="py-4 text-right font-bold">

                                            Rp {{ number_format($detail->subtotal, 0, ',', '.') }}

                                        </td>



                                    </tr>



                                @empty


                                    <tr>

                                        <td colspan="5" class="text-center py-8 text-slate-400">

                                            Belum ada pekerjaan RAB.


                                        </td>

                                    </tr>
                                @endforelse



                            </tbody>


                        </table>


                    </div>




                    <div class="mt-8 bg-slate-50 rounded-2xl p-6 flex justify-between items-center">


                        <div>

                            <p class="text-xs uppercase text-slate-400">
                                Total Estimasi Biaya
                            </p>


                            <p class="text-3xl font-bold text-slate-900 mt-2">

                                Rp {{ number_format($audit->rab->total_biaya, 0, ',', '.') }}

                            </p>


                        </div>



                        <div class="hidden md:block">


                            <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center">


                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 10v-1" />

                                </svg>


                            </div>


                        </div>


                    </div>


                </div>
            @endif



            {{-- =========================================================
    ACTION BUTTON
========================================================= --}}


            <div class="flex justify-end gap-3">


                <a href="{{ route('audits.index') }}"
                    class="px-5 py-2.5 rounded-xl bg-white border border-slate-300 hover:bg-slate-50">

                    Kembali

                </a>



                <a href="{{ route('audits.pdf', $audit->id) }}" target="_blank"
                    class="px-5 py-2.5 rounded-xl bg-red-600 text-white hover:bg-red-700">

                    Unduh Laporan
                </a>


            </div>



            {{-- =========================================================
    MODAL TAMBAH PEKERJAAN
========================================================= --}}



            @if ($audit->rab)
                <div id="modalPekerjaan"
                    class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center px-4">


                    <div class="bg-white rounded-2xl shadow-xl w-full max-w-xl p-8">


                        <div class="flex justify-between items-center mb-6">


                            <h3 class="text-xl font-bold">

                                Tambah Pekerjaan RAB

                            </h3>


                            <button onclick="document.getElementById('modalPekerjaan').classList.add('hidden')"
                                class="text-slate-400 hover:text-red-600 text-2xl">

                                ×

                            </button>


                        </div>




                        <form action="{{ route('rab-details.store') }}" method="POST">


                            @csrf



                            <input type="hidden" name="rab_id" value="{{ $audit->rab->id }}">





                            <div class="mb-5">


                                <label class="block text-sm font-semibold mb-2">

                                    Pilih Pekerjaan

                                </label>


                                <select name="ahsp_id" class="w-full border rounded-xl p-3" required>


                                    <option value="">
                                        -- Pilih AHSP --
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




                            <div class="mb-6">


                                <label class="block text-sm font-semibold mb-2">

                                    Volume

                                </label>


                                <input type="number" step="0.01" min="1" name="volume"
                                    class="w-full border rounded-xl p-3" required>


                            </div>




                            <div class="flex justify-end gap-3">


                                <button type="button"
                                    onclick="document.getElementById('modalPekerjaan').classList.add('hidden')"
                                    class="px-5 py-2 rounded-xl bg-slate-200">

                                    Batal

                                </button>



                                <button type="submit" class="px-5 py-2 rounded-xl bg-blue-600 text-white">

                                    Simpan

                                </button>


                            </div>



                        </form>



                    </div>



                </div>
            @endif



        @endsection
