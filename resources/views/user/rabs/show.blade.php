@extends('layouts.user')

@section('content')
    <div class="mb-6 flex items-center justify-between">
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

        <!-- Tabel Detail Pekerjaan -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-center">No</th>
                        <th class="px-4 py-3 text-left">Pekerjaan</th>
                        <th class="px-4 py-3 text-right">Volume</th>
                        <th class="px-4 py-3 text-right">Harga Satuan</th>
                        <th class="px-4 py-3 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($rab->details as $detail)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3 text-center text-slate-500">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-medium text-slate-800">{{ $detail->ahsp->nama_pekerjaan }}</td>
                            <td class="px-4 py-3 text-right text-slate-600">
                                {{ number_format($detail->volume, 2, ',', '.') }}</td>
                            <td class="px-4 py-3 text-right text-slate-600">Rp
                                {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-right font-semibold text-slate-800">Rp
                                {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t-2 border-slate-100">
                        <td colspan="4" class="px-4 py-4 text-right font-bold text-slate-800">Total Keseluruhan</td>
                        <td class="px-4 py-4 text-right font-bold text-emerald-600 text-lg">Rp
                            {{ number_format($rab->total_biaya, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
