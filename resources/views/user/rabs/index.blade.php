@extends('layouts.user')

@section('content')
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-bold text-slate-800">Data RAB</h2>
        <a href="{{ route('rabs.create') }}"
            class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-xl font-semibold transition shadow-sm">
            + Tambah RAB
        </a>
    </div>

    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
        @forelse ($rabs as $rab)
            <article class="group rounded-3xl border border-slate-200/70 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-violet-200 hover:shadow-xl hover:shadow-violet-900/5">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-xl">📑</div>
                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">Rp {{ number_format($rab->total_biaya, 0, ',', '.') }}</span>
                </div>
                <p class="mt-6 text-xs font-bold uppercase tracking-widest text-slate-400">{{ $rab->nomor_rab }}</p>
                <h3 class="mt-2 text-lg font-bold text-slate-900">Audit {{ $rab->audit->nomor_audit ?? '-' }}</h3>
                <p class="mt-1 text-sm text-slate-500">{{ \Carbon\Carbon::parse($rab->tanggal_rab)->format('d M Y') }}</p>
                <a href="{{ route('rabs.show', $rab->id) }}" class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-4 py-3 text-sm font-bold text-white transition group-hover:bg-emerald-600">Lihat Detail RAB <span class="ml-2">→</span></a>
            </article>
        @empty
            <div class="col-span-full rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center text-sm text-slate-500">Belum ada data RAB.</div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $rabs->links() }}
    </div>
@endsection
