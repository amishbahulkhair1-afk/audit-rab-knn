@extends('layouts.user')

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-bold text-slate-800">Detail RAB</h2>
        <a href="{{ url()->previous() }}" class="text-sm text-slate-500 hover:text-slate-800 transition">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
        <!-- Informasi Meta Data -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 pb-8 border-b border-slate-100">
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase">Nomor RAB</label>
                <p class="text-lg font-bold text-slate-800">{{ $rab->nomor_rab }}</p>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase">Nomor Audit</label>
                <p class="text-lg font-bold text-slate-800">{{ $rab->audit->nomor_audit ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase">Tanggal</label>
                <p class="text-lg font-bold text-slate-800">{{ \Carbon\Carbon::parse($rab->tanggal_rab)->format('d M Y') }}
                </p>
            </div>
        </div>

        <!-- Detail Pekerjaan -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            @forelse ($rab->details as $detail)
                <article class="rounded-2xl border border-slate-200/70 bg-slate-50/70 p-5">
                    <div class="flex items-start justify-between gap-3">
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-50 text-sm font-bold text-emerald-700">{{ $loop->iteration }}</span>
                        <p class="text-lg font-bold text-emerald-600">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                    </div>
                    <h3 class="mt-4 font-bold text-slate-900">{{ $detail->ahsp->nama_pekerjaan }}</h3>
                    <div class="mt-3 grid grid-cols-2 gap-3 text-sm">
                        <div><p class="text-xs text-slate-400">Volume</p><p class="font-semibold text-slate-700">{{ number_format($detail->volume, 2, ',', '.') }}</p></div>
                        <div><p class="text-xs text-slate-400">Harga Satuan</p><p class="font-semibold text-slate-700">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</p></div>
                    </div>
                </article>
            @empty
                <p class="col-span-full rounded-2xl border border-dashed border-slate-300 p-8 text-center text-sm text-slate-400">Belum ada detail pekerjaan.</p>
            @endforelse
        </div>
        <div class="mt-6 flex items-center justify-between rounded-2xl bg-emerald-50 p-5">
            <span class="font-bold text-slate-800">Total Keseluruhan</span>
            <span class="text-xl font-extrabold text-emerald-600">Rp {{ number_format($rab->total_biaya, 0, ',', '.') }}</span>
        </div>
    </div>
@endsection
