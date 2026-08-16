@extends('layouts.user')
@section('content')
    <div class="py-8">
        <div class="w-full space-y-8">
            {{-- HEADER --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-slate-500">Dashboard / Audit / Detail</p>
                    <h1 class="text-3xl font-bold text-slate-800 mt-1">Detail Audit Bangunan</h1>
                    <p class="text-slate-500 mt-2">Informasi lengkap audit bangunan, hasil klasifikasi KNN, serta estimasi RAB.</p>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('audits.index') }}"
                        class="px-5 py-2.5 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 font-semibold">Kembali</a>
                    <a href="{{ route('audits.pdf', $audit->id) }}" target="_blank"
                        class="px-5 py-2.5 rounded-xl bg-red-600 text-white hover:bg-red-700">Unduh Laporan</a>
                </div>
            </div>
            {{-- SUMMARY CARDS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <p class="text-xs uppercase tracking-widest text-slate-400">Nomor Audit</p>
                    <h2 class="text-xl font-bold mt-3">{{ $audit->nomor_audit }}</h2>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <p class="text-xs uppercase tracking-widest text-slate-400">Auditor</p>
                    <h2 class="text-xl font-bold mt-3">{{ $audit->user->name }}</h2>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <p class="text-xs uppercase tracking-widest text-slate-400">Hasil KNN</p>
                    @if ($audit->hasil_knn)
                        @php $layak = str_contains(strtolower($audit->hasil_knn), 'layak'); @endphp
                        <span class="inline-flex mt-3 px-4 py-2 rounded-full text-sm font-bold {{ $layak ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $audit->hasil_knn }}
                        </span>
                    @else
                        <span class="inline-flex mt-3 px-4 py-2 rounded-full bg-yellow-100 text-yellow-700">Belum Diproses</span>
                    @endif
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <p class="text-xs uppercase tracking-widest text-slate-400">Total RAB</p>
                    <h2 class="text-xl font-bold mt-3">
                        @if ($audit->rab) Rp {{ number_format($audit->rab->total_biaya, 0, ',', '.') }} @else - @endif
                    </h2>
                </div>
            </div>
            {{-- INFORMASI AUDIT --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                <h3 class="text-lg font-bold mb-8">Informasi Audit</h3>
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <label class="text-xs uppercase text-slate-400">Nomor Audit</label>
                        <p class="font-semibold mt-1">{{ $audit->nomor_audit }}</p>
                    </div>
                    <div>
                        <label class="text-xs uppercase text-slate-400">Tanggal Audit</label>
                        <p class="font-semibold mt-1">{{ \Carbon\Carbon::parse($audit->tanggal_audit)->format('d F Y') }}</p>
                    </div>
                    <div>
                        <label class="text-xs uppercase text-slate-400">Nama Bangunan</label>
                        <p class="font-semibold mt-1">{{ $audit->building->nama_bangunan }}</p>
                    </div>
                    <div>
                        <label class="text-xs uppercase text-slate-400">Jenis Konstruksi</label>
                        <p class="font-semibold mt-1">{{ $audit->building->jenis_konstruksi }}</p>
                    </div>
                    <div>
                        <label class="text-xs uppercase text-slate-400">Auditor</label>
                        <p class="font-semibold mt-1">{{ $audit->user->name }}</p>
                    </div>
                </div>
            </div>
            {{-- HASIL + KOMPONEN --}}
            <div class="grid lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <h3 class="font-bold text-lg mb-5">Hasil Klasifikasi</h3>
                    @if ($audit->hasil_knn)
                        @php $layak = str_contains(strtolower($audit->hasil_knn), 'layak'); @endphp
                        <div class="rounded-xl p-6 {{ $layak ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200' }}">
                            <div class="text-3xl font-bold">{{ $audit->hasil_knn }}</div>
                            <p class="text-sm text-slate-500 mt-3">Hasil klasifikasi menggunakan algoritma K-Nearest Neighbor.</p>
                        </div>
                    @else
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">Belum dilakukan klasifikasi.</div>
                    @endif
                </div>
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <h3 class="font-bold text-lg mb-5">Penilaian Komponen</h3>
                    <div class="space-y-4">
                        @foreach ($audit->details as $detail)
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="font-medium">{{ ucfirst($detail->komponen) }}</span>
                                    <span class="font-bold">{{ $detail->nilai }}</span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-3">
                                    <div class="h-3 rounded-full bg-gradient-to-r from-emerald-500 to-teal-500" style="width:{{ $detail->nilai * 20 }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @include('user.audits.partials._knn-rekomendasi')
            @include('user.audits.partials._rab')
            {{-- ACTION BUTTONS --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('audits.index') }}"
                    class="px-5 py-2.5 rounded-xl bg-white border border-slate-300 hover:bg-slate-50">Kembali</a>
                <a href="{{ route('audits.pdf', $audit->id) }}" target="_blank"
                    class="px-5 py-2.5 rounded-xl bg-red-600 text-white hover:bg-red-700">Unduh Laporan</a>
            </div>
        </div>
    </div>
@endsection
