@extends('layouts.user')

@section('content')
    <div class="space-y-8">


        {{-- =========================================================
        WELCOME BANNER
    ========================================================== --}}

        <div class="bg-gradient-to-r from-emerald-700 to-emerald-500 rounded-3xl p-8 text-white shadow-lg">


            <div class="flex flex-col md:flex-row 
                    justify-between items-start md:items-center gap-6">


                <div>


                    <div class="flex items-center gap-2 mb-3">

                        <span
                            class="bg-white/20 px-3 py-1 rounded-full 
                               text-xs font-semibold">

                            Pengurus PU

                        </span>

                    </div>



                    <h1 class="text-3xl font-bold">

                        👋 Selamat Datang,
                        {{ Auth::user()->name }}

                    </h1>



                    <p class="mt-3 text-emerald-50 max-w-xl">

                        Kelola data bangunan, lakukan audit kelayakan,
                        dan susun estimasi Rencana Anggaran Biaya
                        melalui Sistem Audit Bangunan.

                    </p>


                </div>



                <div class="bg-white/10 backdrop-blur-md 
                       rounded-2xl px-6 py-4">


                    <p class="text-xs text-emerald-100 uppercase">

                        Hari ini

                    </p>


                    <p class="text-xl font-bold">

                        {{ now()->translatedFormat('d F Y') }}

                    </p>


                </div>


            </div>

        </div>

        <div class="space-y-2">

            {{-- =========================================================
        STATISTIK CARD
    ========================================================== --}}


            <div class="grid grid-cols-1 sm:grid-cols-2 
                xl:grid-cols-4 gap-6">



                {{-- Bangunan --}}

                <a href="{{ route('buildings.index') }}"
                    class="bg-white rounded-2xl p-6 border border-slate-100
                  shadow-sm hover:shadow-md transition">


                    <div class="flex justify-between items-start">


                        <div>

                            <p class="text-xs uppercase 
                              font-bold text-slate-400">

                                Total Bangunan

                            </p>


                            <h2 class="text-3xl font-bold 
                               text-slate-900 mt-3">

                                {{ $totalBangunanUser }}

                            </h2>


                            <p class="text-sm text-slate-500 mt-1">

                                Bangunan terdaftar

                            </p>


                        </div>


                        <div
                            class="w-12 h-12 rounded-xl 
                           bg-blue-50 text-blue-600
                           flex items-center justify-center">


                            🏢


                        </div>


                    </div>


                </a>

                {{-- Audit --}}

                <a href="{{ route('audits.index') }}"
                    class="bg-white rounded-2xl p-6 border border-slate-100
                  shadow-sm hover:shadow-md transition">


                    <div class="flex justify-between items-start">


                        <div>


                            <p class="text-xs uppercase 
                              font-bold text-slate-400">

                                Audit Saya

                            </p>


                            <h2 class="text-3xl font-bold 
                               text-slate-900 mt-3">

                                {{ $totalAuditUser }}

                            </h2>


                            <p class="text-sm text-slate-500 mt-1">

                                Audit dilakukan

                            </p>


                        </div>


                        <div
                            class="w-12 h-12 rounded-xl
                           bg-amber-50 text-amber-600
                           flex items-center justify-center">

                            📋

                        </div>


                    </div>


                </a>

                {{-- RAB --}}

                <a href="{{ route('rabs.index') }}"
                    class="bg-white rounded-2xl p-6 border border-slate-100
                  shadow-sm hover:shadow-md transition">


                    <div class="flex justify-between items-start">


                        <div>


                            <p class="text-xs uppercase 
                              font-bold text-slate-400">

                                RAB Saya

                            </p>


                            <h2 class="text-3xl font-bold 
                               text-slate-900 mt-3">

                                {{ $totalRabUser }}

                            </h2>


                            <p class="text-sm text-slate-500 mt-1">

                                RAB tersusun

                            </p>


                        </div>


                        <div
                            class="w-12 h-12 rounded-xl
                           bg-purple-50 text-purple-600
                           flex items-center justify-center">

                            📑

                        </div>


                    </div>


                </a>

                {{-- Total Biaya --}}

                <div class="bg-white rounded-2xl p-6 border border-slate-100
                   shadow-sm">


                    <div class="flex justify-between items-start">


                        <div>


                            <p class="text-xs uppercase 
                              font-bold text-slate-400">

                                Total Anggaran

                            </p>


                            <h2 class="text-xl font-bold 
                               text-slate-900 mt-4">

                                Rp
                                {{ number_format($totalBiayaRabUser, 0, ',', '.') }}

                            </h2>


                            <p class="text-sm text-slate-500 mt-2">

                                Nilai seluruh RAB

                            </p>


                        </div>


                        <div
                            class="w-12 h-12 rounded-xl
                           bg-emerald-50 text-emerald-600
                           flex items-center justify-center">

                            💰

                        </div>


                    </div>


                </div>



            </div>

        </div>

        {{-- =========================================================
    QUICK ACTION
========================================================== --}}

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">


            {{-- Audit Baru --}}

            <a href="{{ route('audits.create') }}"
                class="group bg-gradient-to-br from-emerald-600 to-emerald-500
              rounded-2xl p-6 text-white shadow-md
              hover:shadow-xl transition">


                <div class="flex justify-between items-start">


                    <div>

                        <p class="text-sm text-emerald-100">
                            Mulai pekerjaan
                        </p>


                        <h3 class="text-xl font-bold mt-2">
                            Audit Bangunan
                        </h3>


                    </div>


                    <span class="text-3xl">
                        📝
                    </span>


                </div>


                <p class="text-sm text-emerald-100 mt-5">
                    Lakukan pemeriksaan kondisi bangunan.
                </p>


            </a>
            {{-- Data Bangunan --}}

            <a href="{{ route('buildings.index') }}"
                class="group bg-white rounded-2xl p-6
              border border-slate-100 shadow-sm
              hover:shadow-md transition">


                <div class="flex justify-between">


                    <div>

                        <p class="text-sm text-slate-400">
                            Kelola
                        </p>


                        <h3 class="text-xl font-bold text-slate-800 mt-2">
                            Bangunan
                        </h3>


                    </div>


                    <span class="text-3xl">
                        🏢
                    </span>


                </div>


                <p class="text-sm text-slate-500 mt-5">
                    Lihat data bangunan terdaftar.
                </p>


            </a>

            {{-- RAB --}}

            <a href="{{ route('rabs.index') }}"
                class="group bg-white rounded-2xl p-6
              border border-slate-100 shadow-sm
              hover:shadow-md transition">


                <div class="flex justify-between">


                    <div>

                        <p class="text-sm text-slate-400">
                            Perencanaan
                        </p>


                        <h3 class="text-xl font-bold text-slate-800 mt-2">
                            Rencana Anggaran
                        </h3>


                    </div>


                    <span class="text-3xl">
                        💰
                    </span>


                </div>


                <p class="text-sm text-slate-500 mt-5">
                    Kelola estimasi biaya pembangunan.
                </p>


            </a>

            {{-- Riwayat --}}

            <a href="{{ route('audits.index') }}"
                class="group bg-white rounded-2xl p-6
              border border-slate-100 shadow-sm
              hover:shadow-md transition">


                <div class="flex justify-between">


                    <div>

                        <p class="text-sm text-slate-400">
                            Riwayat
                        </p>


                        <h3 class="text-xl font-bold text-slate-800 mt-2">
                            Audit Saya
                        </h3>


                    </div>


                    <span class="text-3xl">
                        📚
                    </span>


                </div>


                <p class="text-sm text-slate-500 mt-5">
                    Lihat seluruh pemeriksaan.
                </p>


            </a>



        </div>

        {{-- =========================================================
    AUDIT TERBARU
========================================================== --}}


        <div class="bg-white rounded-2xl border border-slate-100
            shadow-sm overflow-hidden">


            <div class="p-6 border-b border-slate-100">


                <h3 class="text-lg font-bold text-slate-900">
                    Audit Terbaru Saya
                </h3>


                <p class="text-sm text-slate-500">
                    Riwayat pemeriksaan bangunan terakhir
                </p>


            </div>




            <div class="overflow-x-auto">


                <table class="w-full text-sm">


                    <thead class="bg-slate-50">


                        <tr class="text-left text-slate-500">


                            <th class="px-6 py-4">
                                Nomor Audit
                            </th>


                            <th class="px-6 py-4">
                                Bangunan
                            </th>


                            <th class="px-6 py-4">
                                Tanggal
                            </th>


                            <th class="px-6 py-4">
                                Status
                            </th>


                        </tr>


                    </thead>




                    <tbody>


                        @forelse($auditTerbaruUser as $audit)
                            <tr class="border-t">


                                <td class="px-6 py-4 font-semibold">
                                    {{ $audit->nomor_audit }}
                                </td>



                                <td class="px-6 py-4">
                                    {{ $audit->building->nama_bangunan ?? '-' }}
                                </td>



                                <td class="px-6 py-4">

                                    {{ \Carbon\Carbon::parse($audit->tanggal_audit)->format('d M Y') }}

                                </td>




                                <td class="px-6 py-4">


                                    @if ($audit->hasil_knn == 'Layak')
                                        <span
                                            class="px-3 py-1 rounded-full
                                         bg-emerald-100
                                         text-emerald-700
                                         text-xs font-bold">

                                            Layak

                                        </span>
                                    @elseif($audit->hasil_knn == 'Kurang Layak')
                                        <span
                                            class="px-3 py-1 rounded-full
                                         bg-yellow-100
                                         text-yellow-700
                                         text-xs font-bold">

                                            Kurang Layak

                                        </span>
                                    @elseif($audit->hasil_knn == 'Tidak Layak')
                                        <span
                                            class="px-3 py-1 rounded-full
                                         bg-red-100
                                         text-red-700
                                         text-xs font-bold">

                                            Tidak Layak

                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 rounded-full
                                         bg-slate-100
                                         text-slate-600
                                         text-xs font-bold">

                                            Belum Diproses

                                        </span>
                                    @endif


                                </td>


                            </tr>


                        @empty


                            <tr>

                                <td colspan="4" class="text-center py-8 text-slate-500">

                                    Belum ada audit

                                </td>

                            </tr>
                        @endforelse



                    </tbody>


                </table>


            </div>


        </div>

        {{-- =========================================================
    RAB TERBARU
========================================================== --}}


        <div class="bg-white rounded-2xl border border-slate-100
            shadow-sm overflow-hidden">


            <div class="p-6 border-b border-slate-100">


                <h3 class="text-lg font-bold text-slate-900">
                    RAB Terbaru Saya
                </h3>


                <p class="text-sm text-slate-500">
                    Estimasi anggaran yang telah dibuat
                </p>


            </div>




            <div class="overflow-x-auto">


                <table class="w-full text-sm">


                    <thead class="bg-slate-50">


                        <tr class="text-left text-slate-500">


                            <th class="px-6 py-4">
                                Nomor RAB
                            </th>


                            <th class="px-6 py-4">
                                Bangunan
                            </th>


                            <th class="px-6 py-4">
                                Total Biaya
                            </th>


                        </tr>


                    </thead>



                    <tbody>


                        @forelse($rabTerbaruUser as $rab)
                            <tr class="border-t">


                                <td class="px-6 py-4 font-semibold">

                                    {{ $rab->nomor_rab }}

                                </td>



                                <td class="px-6 py-4">

                                    {{ $rab->audit->building->nama_bangunan ?? '-' }}

                                </td>




                                <td class="px-6 py-4 font-bold text-emerald-600">


                                    Rp
                                    {{ number_format($rab->total_biaya, 0, ',', '.') }}


                                </td>



                            </tr>


                        @empty


                            <tr>

                                <td colspan="3" class="text-center py-8 text-slate-500">

                                    Belum ada RAB

                                </td>

                            </tr>
                        @endforelse



                    </tbody>


                </table>


            </div>


        </div>

    </div>
@endsection
