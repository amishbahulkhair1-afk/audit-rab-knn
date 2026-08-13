<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between items-center">
            <div>
                <h2 class="font-bold text-xl text-slate-800">Detail Audit Bangunan</h2>
                <p class="text-sm text-slate-500 mt-1">Informasi pemeriksaan dan hasil klasifikasi bangunan</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('audits.index') }}"
                    class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-xl text-sm font-semibold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                {{-- HEADER CARD --}}
                <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 px-6 py-5 text-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-bold">{{ $audit->building->nama_bangunan }}</h3>
                            <p class="text-emerald-100 text-sm mt-1">Nomor Audit : {{ $audit->nomor_audit }}</p>
                        </div>
                        <div>
                            @if ($audit->hasil_knn)
                                <span class="px-4 py-2 rounded-full bg-white/20 text-white text-sm font-bold backdrop-blur">{{ $audit->hasil_knn }}</span>
                            @else
                                <span class="px-4 py-2 rounded-full bg-white/20 text-white text-sm font-bold">Belum Diproses</span>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- INFORMASI UTAMA --}}
                <div class="p-6">
                    <h3 class="text-lg font-bold text-slate-800 mb-5">Informasi Utama Audit</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs uppercase font-bold text-slate-400">Tanggal Audit</p>
                            <p class="mt-1 font-semibold text-slate-700">{{ \Carbon\Carbon::parse($audit->tanggal_audit)->translatedFormat('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase font-bold text-slate-400">Jenis Konstruksi</p>
                            <p class="mt-1 font-semibold text-slate-700">{{ $audit->building->jenis_konstruksi }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase font-bold text-slate-400">Auditor Lapangan</p>
                            <p class="mt-1 font-semibold text-slate-700">{{ $audit->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase font-bold text-slate-400">Rayon</p>
                            <p class="mt-1 font-semibold text-slate-700">{{ $audit->building->rayon }}</p>
                        </div>
                    </div>
                </div>
                @include('audits.partials._knn-table')
                @include('audits.partials._skor-komponen')
                @include('audits.partials._rekomendasi')
                @include('audits.partials._rab')
                {{-- ACTION BUTTONS --}}
                <div class="border-t border-slate-100 px-6 py-5 flex justify-end gap-3">
                    <a href="{{ route('audits.index') }}"
                        class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-xl text-sm font-semibold">
                        Kembali
                    </a>
                    <a href="{{ route('audits.pdf', $audit->id) }}"
                        class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl text-sm font-semibold">
                        Cetak PDF
                    </a>
                    @if (!$audit->rab)
                        <form action="{{ route('rabs.create-from-audit', $audit->id) }}" method="POST">
                            @csrf
                            <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-sm font-semibold">
                                Buat Formulir RAB
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
