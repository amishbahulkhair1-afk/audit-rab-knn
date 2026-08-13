{{-- SKOR KOMPONEN BANGUNAN --}}
<div class="border-t border-slate-100 px-6 py-6">
    <div class="flex items-center gap-3 mb-5">
        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-bold text-slate-800">Skor Penilaian Komponen Elemen Bangunan</h3>
            <p class="text-sm text-slate-500">Nilai kondisi setiap elemen bangunan</p>
        </div>
    </div>
    <div class="overflow-x-auto rounded-xl border border-slate-100">
        <table class="w-full text-sm">
            <thead class="bg-slate-50">
                <tr class="text-left text-slate-500">
                    <th class="px-5 py-4">No</th>
                    <th class="px-5 py-4">Komponen Elemen</th>
                    <th class="px-5 py-4 text-center">Nilai</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($audit->details as $detail)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-4 text-slate-400">{{ $loop->iteration }}</td>
                        <td class="px-5 py-4 font-medium text-slate-700">{{ ucfirst($detail->komponen) }}</td>
                        <td class="px-5 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 font-bold">
                                {{ $detail->nilai }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-8 text-slate-400">Belum ada nilai komponen.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
