{{-- TETANGGA TERDEKAT --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold">Tetangga Terdekat (K = 3)</h3>
        <span class="text-sm text-slate-400">Hasil Perhitungan KNN</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-3">Kode</th>
                    <th class="text-left py-3">Jenis</th>
                    <th class="text-left py-3">Kategori</th>
                    <th class="text-right py-3">Jarak</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($audit->knnResults as $result)
                    <tr class="border-b hover:bg-slate-50">
                        <td class="py-4">{{ $result->dataSet->kode_data }}</td>
                        <td>{{ $result->dataSet->jenis_konstruksi }}</td>
                        <td>
                            <span class="px-3 py-1 rounded-full bg-slate-100 text-sm">{{ $result->dataSet->kategori }}</span>
                        </td>
                        <td class="text-right font-semibold">{{ number_format($result->distance, 4) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- REKOMENDASI TEKNIS & EVALUASI KELAYAKAN --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-100 pb-6">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Rekomendasi Teknis & Evaluasi Kelayakan</h3>
            <p class="text-slate-500 text-sm mt-1">Rekomendasi tindakan teknis serta mitigasi risiko untuk tiap elemen bangunan.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            @php
                $statusBgClass = match ($recommendation['status_bangunan']) {
                    'Tidak Layak Ditempati' => 'bg-red-100 text-red-800 border-red-200',
                    'Layak Ditempati dengan Pembatasan' => 'bg-amber-100 text-amber-800 border-amber-200',
                    default => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                };
                $prioritasBgClass = match ($recommendation['prioritas']) {
                    'Tinggi' => 'bg-red-600 text-white',
                    'Sedang' => 'bg-amber-500 text-white',
                    default => 'bg-emerald-600 text-white',
                };
            @endphp
            <span class="px-4 py-2 rounded-xl border text-xs font-bold {{ $statusBgClass }}">Status: {{ $recommendation['status_bangunan'] }}</span>
            <span class="px-4 py-2 rounded-xl text-xs font-bold {{ $prioritasBgClass }}">Prioritas: {{ $recommendation['prioritas'] }}</span>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b text-xs uppercase text-slate-400">
                    <th class="text-left py-3">Komponen</th>
                    <th class="text-center py-3">Kondisi</th>
                    <th class="text-left py-3">Rekomendasi Tindakan</th>
                    <th class="text-left py-3">Risiko Potensial</th>
                    <th class="text-center py-3">Prioritas</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach ($recommendation['items'] as $item)
                    @php
                        $itemBadge = match ($item['prioritas']) {
                            'Tinggi' => 'bg-red-100 text-red-700',
                            'Sedang' => 'bg-amber-100 text-amber-700',
                            default => 'bg-slate-100 text-slate-600',
                        };
                        $skorBadge = match (true) {
                            $item['nilai'] <= 2 => 'bg-red-50 text-red-700 border-red-200',
                            $item['nilai'] == 3 => 'bg-amber-50 text-amber-700 border-amber-200',
                            default => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                        };
                    @endphp
                    <tr class="hover:bg-slate-50">
                        <td class="py-4 font-semibold text-slate-700">{{ $item['komponen'] }}</td>
                        <td class="py-4 text-center">
                            <span class="px-3 py-1 rounded-lg text-xs font-semibold border {{ $skorBadge }}">{{ $item['nilai'] }} - {{ $item['status'] }}</span>
                        </td>
                        <td class="py-4 text-slate-700">{{ $item['rekomendasi'] }}</td>
                        <td class="py-4 text-slate-500 text-xs italic">{{ $item['risiko'] }}</td>
                        <td class="py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $itemBadge }}">{{ $item['prioritas'] }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
