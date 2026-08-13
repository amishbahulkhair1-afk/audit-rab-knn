@extends('layouts.user')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Data RAB</h2>
        <a href="{{ route('rabs.create') }}"
            class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-xl font-semibold transition shadow-sm">
            + Tambah RAB
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4 text-left font-bold">Nomor RAB</th>
                        <th class="px-6 py-4 text-left font-bold">Audit</th>
                        <th class="px-6 py-4 text-left font-bold">Tanggal</th>
                        <th class="px-6 py-4 text-left font-bold">Total Biaya</th>
                        <th class="px-6 py-4 text-center font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($rabs as $rab)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-medium text-slate-800">{{ $rab->nomor_rab }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $rab->audit->nomor_audit ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-600">
                                {{ \Carbon\Carbon::parse($rab->tanggal_rab)->format('d M Y') }}</td>
                            <td class="px-6 py-4 font-semibold text-emerald-600">Rp
                                {{ number_format($rab->total_biaya, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('rabs.show', $rab->id) }}"
                                    class="inline-flex items-center justify-center px-4 py-2 bg-slate-100 hover:bg-blue-600 text-slate-600 hover:text-white rounded-lg transition font-medium text-xs">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $rabs->links() }}
    </div>
@endsection
