{{-- ANALISIS KNN --}}
<div class="border-t border-slate-100 px-6 py-6">
    <div class="flex items-center gap-3 mb-5">
        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-bold text-slate-800">Analisis Klasifikasi Tetangga Terdekat (K=3)</h3>
            <p class="text-sm text-slate-500">Perhitungan jarak Euclidean terhadap data training</p>
        </div>
    </div>
    <div class="overflow-x-auto rounded-xl border border-slate-100">
        <table class="w-full text-sm">
            <thead class="bg-slate-50">
                <tr class="text-left text-slate-500">
                    <th class="px-5 py-4 font-semibold">No</th>
                    <th class="px-5 py-4 font-semibold">Kode Data</th>
                    <th class="px-5 py-4 font-semibold">Jenis Konstruksi</th>
                    <th class="px-5 py-4 font-semibold">Kategori</th>
                    <th class="px-5 py-4 font-semibold text-right">Jarak Euclidean</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($audit->knnResults as $result)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-4 text-slate-400">{{ $loop->iteration }}</td>
                        <td class="px-5 py-4 font-mono font-semibold text-slate-700">{{ $result->dataSet->kode_data }}</td>
                        <td class="px-5 py-4">{{ $result->dataSet->jenis_konstruksi }}</td>
                        <td class="px-5 py-4">
                            @php $kategori = strtolower($result->dataSet->kategori); @endphp
                            @if (str_contains($kategori, 'layak'))
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">{{ $result->dataSet->kategori }}</span>
                            @elseif(str_contains($kategori, 'kurang'))
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">{{ $result->dataSet->kategori }}</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">{{ $result->dataSet->kategori }}</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-right font-mono font-semibold">{{ number_format($result->distance, 4) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-slate-400">Data KNN belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
