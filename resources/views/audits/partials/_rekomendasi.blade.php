{{-- REKOMENDASI TEKNIS & HASIL EVALUASI --}}
<div class="border-t border-slate-100 px-6 py-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-slate-800">Rekomendasi Teknis & Evaluasi Kelayakan</h3>
                <p class="text-sm text-slate-500">Hasil rekomendasi penanganan otomatis berdasarkan kondisi tiap elemen bangunan</p>
            </div>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            @php
                $statusBgClass = match ($recommendation['status_bangunan']) {
                    'Tidak Layak Ditempati' => 'bg-rose-100 text-rose-800 border-rose-200',
                    'Layak Ditempati dengan Pembatasan' => 'bg-amber-100 text-amber-800 border-amber-200',
                    default => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                };
                $prioritasBgClass = match ($recommendation['prioritas']) {
                    'Tinggi' => 'bg-rose-600 text-white',
                    'Sedang' => 'bg-amber-500 text-white',
                    default => 'bg-emerald-600 text-white',
                };
            @endphp
            <div class="px-4 py-2 rounded-xl border text-xs font-bold flex items-center gap-2 {{ $statusBgClass }}">
                <span>Status: {{ $recommendation['status_bangunan'] }}</span>
            </div>
            <div class="px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-2 {{ $prioritasBgClass }}">
                <span>Prioritas: {{ $recommendation['prioritas'] }}</span>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto rounded-xl border border-slate-100">
        <table class="w-full text-sm">
            <thead class="bg-slate-50">
                <tr class="text-left text-slate-500">
                    <th class="px-5 py-4 font-semibold">Komponen</th>
                    <th class="px-5 py-4 font-semibold text-center">Kondisi</th>
                    <th class="px-5 py-4 font-semibold">Rekomendasi Tindakan</th>
                    <th class="px-5 py-4 font-semibold">Risiko Potensial</th>
                    <th class="px-5 py-4 font-semibold text-center">Prioritas</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($recommendation['items'] as $item)
                    @php
                        $itemBadge = match ($item['prioritas']) {
                            'Tinggi' => 'bg-rose-100 text-rose-700',
                            'Sedang' => 'bg-amber-100 text-amber-700',
                            default => 'bg-slate-100 text-slate-600',
                        };
                        $skorBadge = match (true) {
                            $item['nilai'] <= 2 => 'bg-rose-50 text-rose-700 border-rose-200',
                            $item['nilai'] == 3 => 'bg-amber-50 text-amber-700 border-amber-200',
                            default => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                        };
                    @endphp
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-4 font-medium text-slate-800">{{ $item['komponen'] }}</td>
                        <td class="px-5 py-4 text-center">
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-lg text-xs font-semibold border {{ $skorBadge }}">
                                <span class="font-bold">{{ $item['nilai'] }}</span> - {{ $item['status'] }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-slate-700">{{ $item['rekomendasi'] }}</td>
                        <td class="px-5 py-4 text-slate-500 text-xs italic">{{ $item['risiko'] }}</td>
                        <td class="px-5 py-4 text-center">
                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold {{ $itemBadge }}">
                                {{ $item['prioritas'] }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
