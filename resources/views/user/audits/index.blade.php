@extends('layouts.user')

@section('content')
<div class="py-10">
    <div class="max-w-6xl mx-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">{{ __('Audit Bangunan') }}</h2>
                <p class="text-sm text-slate-500 mt-1">{{ __('Daftar hasil audit kondisi bangunan.') }}</p>
            </div>
            <a href="{{ route('audits.create') }}" 
               class="px-5 py-2.5 bg-blue-600 text-white text-[10px] font-bold uppercase tracking-widest rounded-lg hover:bg-blue-700 shadow-sm transition">
                {{ __('Tambah Audit') }}
            </a>
        </div>

        <!-- Tabel Data -->
        <div class="bg-white shadow-xs sm:rounded-xl border border-slate-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Nomor Audit</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Bangunan</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Hasil</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($audits as $audit)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $audit->nomor_audit }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $audit->building->nama_bangunan }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ \Carbon\Carbon::parse($audit->tanggal_audit)->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-medium bg-emerald-50 text-emerald-800">
                                    {{ $audit->hasil_knn }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <a href="{{ route('audits.show', $audit->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 text-[10px] font-bold uppercase tracking-widest px-2">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-500 text-sm">
                                {{ __('Belum ada data audit.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $audits->links() }}
        </div>

    </div>
</div>
@endsection