@extends('layouts.user')
@section('content')
    <div class="space-y-10">
        {{-- WELCOME BANNER --}}
        <div class="relative isolate overflow-hidden rounded-[2rem] bg-slate-950 p-7 text-white shadow-2xl shadow-slate-900/15 sm:p-9 lg:p-10">
            <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_80%_15%,rgba(16,185,129,.35),transparent_32%),linear-gradient(135deg,#022c22_0%,#064e3b_48%,#0f172a_100%)]"></div>
            <div class="absolute -right-24 -top-32 -z-10 h-80 w-80 rounded-full border border-emerald-200/10"></div>
            <div class="absolute -bottom-40 right-16 -z-10 h-80 w-80 rounded-full bg-emerald-400/10 blur-3xl"></div>
            <div class="relative flex flex-col items-start justify-between gap-8 md:flex-row md:items-center">
                <div>
                    <div class="mb-4 flex items-center gap-2">
                        <span class="rounded-full border border-emerald-300/20 bg-emerald-400/15 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-emerald-100">
                            Ruang kerja Pengurus PU
                        </span>
                    </div>
                    <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl">
                        👋 Selamat Datang,
                        {{ Auth::user()->name }}
                    </h1>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-300 sm:text-base">
                        Kelola data bangunan, lakukan audit kelayakan,
                        dan susun estimasi Rencana Anggaran Biaya
                        melalui Sistem Audit Bangunan.
                    </p>
                </div>
                <div class="min-w-44 rounded-2xl border border-white/10 bg-white/10 px-6 py-4 shadow-lg backdrop-blur-md">
                    <p class="text-xs font-medium uppercase tracking-wider text-emerald-200">
                        Hari ini
                    </p>
                    <p class="mt-1 text-xl font-bold tracking-tight">
                        {{ now()->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="space-y-2">
            {{-- STATISTIK CARD --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
                {{-- Bangunan --}}

                <a href="{{ route('buildings.index') }}"
                    class="group rounded-3xl border border-slate-200/70 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-900/5">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs uppercase font-bold text-slate-400">
                                Total Bangunan
                            </p>
                            <h2 class="text-3xl font-bold text-slate-900 mt-3">
                                {{ $totalBangunanUser }}
                            </h2>
                            <p class="text-sm text-slate-500 mt-1">
                                Bangunan terdaftar
                            </p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 transition group-hover:scale-110">
                            🏢
                        </div>
                    </div>
                </a>
                {{-- Audit --}}

                <a href="{{ route('audits.index') }}"
                    class="group rounded-3xl border border-slate-200/70 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-amber-200 hover:shadow-xl hover:shadow-amber-900/5">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs uppercase font-bold text-slate-400">
                                Audit Saya
                            </p>
                            <h2 class="text-3xl font-bold text-slate-900 mt-3">
                                {{ $totalAuditUser }}
                            </h2>
                            <p class="text-sm text-slate-500 mt-1">
                                Audit dilakukan
                            </p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-600 transition group-hover:scale-110">
                            📋
                        </div>
                    </div>
                </a>
                {{-- RAB --}}

                <a href="{{ route('rabs.index') }}"
                    class="group rounded-3xl border border-slate-200/70 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-violet-200 hover:shadow-xl hover:shadow-violet-900/5">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs uppercase font-bold text-slate-400">
                                RAB Saya
                            </p>
                            <h2 class="text-3xl font-bold text-slate-900 mt-3">
                                {{ $totalRabUser }}
                            </h2>
                            <p class="text-sm text-slate-500 mt-1">
                                RAB tersusun
                            </p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 transition group-hover:scale-110">
                            📑
                        </div>
                    </div>
                </a>
                {{-- Total Biaya --}}

                <div class="rounded-3xl border border-slate-200/70 bg-white p-6 shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs uppercase font-bold text-slate-400">
                                Total Anggaran
                            </p>
                            <h2 class="text-xl font-bold text-slate-900 mt-4">
                                Rp
                                {{ number_format($totalBiayaRabUser, 0, ',', '.') }}
                            </h2>
                            <p class="text-sm text-slate-500 mt-2">
                                Nilai seluruh RAB
                            </p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                            💰
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- QUICK ACTION --}}
        <div class="grid grid-cols-1 gap-5 lg:grid-cols-4">
            {{-- Audit Baru --}}

            <a href="{{ route('audits.create') }}"
                class="group rounded-3xl bg-gradient-to-br from-emerald-600 to-teal-500 p-6 text-white shadow-lg shadow-emerald-900/10 transition hover:-translate-y-1 hover:shadow-xl">
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
                class="group rounded-3xl border border-slate-200/70 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
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
                class="group rounded-3xl border border-slate-200/70 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
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
                class="group rounded-3xl border border-slate-200/70 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
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
        {{-- AUDIT TERBARU --}}
        <div class="overflow-hidden rounded-3xl border border-slate-200/70 bg-white shadow-sm">
            <div class="p-6 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-900">
                    Audit Terbaru Saya
                </h3>
                <p class="text-sm text-slate-500">
                    Riwayat pemeriksaan bangunan terakhir
                </p>
            </div>
            <div class="grid gap-3 p-4 sm:grid-cols-2">
                        @forelse($auditTerbaruUser as $audit)
                            <div class="rounded-2xl border border-slate-100 bg-slate-50/70 p-4 transition hover:border-emerald-200 hover:bg-emerald-50/40">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">{{ $audit->nomor_audit }}</p>
                                        <p class="mt-1 font-semibold text-slate-900">{{ $audit->building->nama_bangunan ?? '-' }}</p>
                                    </div>
                                    <div>
                                    @if ($audit->hasil_knn == 'Layak')
                                        <span
                                            class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold">
                                            Layak
                                        </span>
                                    @elseif($audit->hasil_knn == 'Kurang Layak')
                                        <span
                                            class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">
                                            Kurang Layak
                                        </span>
                                    @elseif($audit->hasil_knn == 'Tidak Layak')
                                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                            Tidak Layak
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-bold">
                                            Belum Diproses
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <p class="mt-3 text-xs text-slate-500">{{ \Carbon\Carbon::parse($audit->tanggal_audit)->format('d M Y') }}</p>
                            </div>
                        @empty
                            <p class="col-span-full py-8 text-center text-sm text-slate-500">Belum ada audit</p>
                        @endforelse
            </div>
        </div>
        {{-- RAB TERBARU --}}
        <div class="overflow-hidden rounded-3xl border border-slate-200/70 bg-white shadow-sm">
            <div class="p-6 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-900">
                    RAB Terbaru Saya
                </h3>
                <p class="text-sm text-slate-500">
                    Estimasi anggaran yang telah dibuat
                </p>
            </div>
            <div class="grid gap-3 p-4 sm:grid-cols-2">
                        @forelse($rabTerbaruUser as $rab)
                            <div class="rounded-2xl border border-slate-100 bg-slate-50/70 p-4 transition hover:border-emerald-200 hover:bg-emerald-50/40">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">{{ $rab->nomor_rab }}</p>
                                        <p class="mt-1 font-semibold text-slate-900">{{ $rab->audit->building->nama_bangunan ?? '-' }}</p>
                                    </div>
                                    <p class="font-bold text-emerald-600">Rp {{ number_format($rab->total_biaya, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-full py-8 text-center text-sm text-slate-500">Belum ada RAB</p>
                        @endforelse
            </div>
        </div>
    </div>
@endsection
