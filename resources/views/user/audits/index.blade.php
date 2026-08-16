@extends('layouts.user')

@section('content')
    <div>

            <!-- Header -->
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">{{ __('Audit Bangunan') }}</h2>
                    <p class="text-sm text-slate-500 mt-1">{{ __('Daftar hasil audit kondisi bangunan.') }}</p>
                </div>
                <a href="{{ route('audits.create') }}"
                    class="px-5 py-2.5 bg-emerald-600 text-white text-[10px] font-bold uppercase tracking-widest rounded-lg hover:bg-emerald-700 shadow-sm transition">
                    {{ __('Tambah Audit') }}
                </a>
            </div>

            <!-- Kartu Data -->
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                @forelse ($audits as $audit)
                    <article class="group rounded-3xl border border-slate-200/70 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-emerald-200 hover:shadow-xl hover:shadow-emerald-900/5">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-xl">📋</div>
                            <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">
                                {{ $audit->hasil_knn ?? 'Belum diproses' }}
                            </span>
                        </div>
                        <p class="mt-6 text-xs font-bold uppercase tracking-widest text-slate-400">{{ $audit->nomor_audit }}</p>
                        <h3 class="mt-2 truncate text-lg font-bold text-slate-900">{{ $audit->building->nama_bangunan ?? '-' }}</h3>
                        <p class="mt-1 text-sm text-slate-500">{{ \Carbon\Carbon::parse($audit->tanggal_audit)->format('d M Y') }}</p>
                        <a href="{{ route('audits.show', $audit->id) }}" class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-4 py-3 text-sm font-bold text-white transition group-hover:bg-emerald-600">Lihat Detail Audit <span class="ml-2">→</span></a>
                    </article>
                @empty
                    <div class="col-span-full rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center text-sm text-slate-500">{{ __('Belum ada data audit.') }}</div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $audits->links() }}
            </div>

        </div>
    </div>
@endsection
