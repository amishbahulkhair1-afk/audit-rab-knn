{{-- RAB PEMULIHAN --}}
@if ($audit->rab)
    <div class="border-t border-slate-100 px-6 py-6">
        <div class="flex justify-between items-center mb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Rencana Anggaran Biaya (RAB)</h3>
                    <p class="text-sm text-slate-500">Estimasi biaya pemulihan bangunan</p>
                </div>
            </div>
            <button onclick="document.getElementById('modalPekerjaan').classList.remove('hidden')"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-sm transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Pekerjaan
            </button>
        </div>
        <div class="overflow-x-auto rounded-xl border border-slate-100">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr class="text-left text-slate-500">
                        <th class="px-5 py-4">No</th>
                        <th class="px-5 py-4">Uraian Pekerjaan</th>
                        <th class="px-5 py-4 text-center">Volume</th>
                        <th class="px-5 py-4 text-right">Harga Satuan</th>
                        <th class="px-5 py-4 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($audit->rab->details as $detail)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-5 py-4 text-slate-400">{{ $loop->iteration }}</td>
                            <td class="px-5 py-4 font-medium text-slate-700">{{ $detail->ahsp->nama_pekerjaan }}</td>
                            <td class="px-5 py-4 text-center">{{ $detail->volume }}</td>
                            <td class="px-5 py-4 text-right font-mono">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                            <td class="px-5 py-4 text-right font-bold text-emerald-600 font-mono">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-slate-400">Belum ada pekerjaan RAB.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if ($audit->rab->details->isNotEmpty())
                    <tfoot class="bg-slate-50">
                        <tr>
                            <td colspan="4" class="px-5 py-4 text-right font-bold text-slate-700">TOTAL ESTIMASI BIAYA</td>
                            <td class="px-5 py-4 text-right font-bold text-lg text-emerald-700 font-mono">
                                Rp {{ number_format($audit->rab->total_biaya, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>
@endif

{{-- MODAL TAMBAH PEKERJAAN --}}
@if ($audit->rab)
    <div id="modalPekerjaan" class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 p-6">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-lg font-bold text-gray-800">Tambah Item Pekerjaan RAB</h3>
                <button onclick="document.getElementById('modalPekerjaan').classList.add('hidden')"
                    class="text-gray-400 hover:text-red-500 text-2xl">&times;</button>
            </div>
            <form action="{{ route('rab-details.store') }}" method="POST">
                @csrf
                <input type="hidden" name="rab_id" value="{{ $audit->rab->id }}">
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-2">
                        Pilih Pekerjaan AHSP <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span>
                    </label>
                    <select name="ahsp_id" class="w-full rounded-lg border-gray-300" required>
                        <option value="">-- Pilih Pekerjaan --</option>
                        @foreach ($ahsps as $ahsp)
                            <option value="{{ $ahsp->id }}">{{ $ahsp->kode }} - {{ $ahsp->nama_pekerjaan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-semibold mb-2">
                        Volume <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span>
                    </label>
                    <input type="number" step="0.01" min="0" name="volume"
                        class="w-full rounded-lg border-gray-300" placeholder="Contoh: 10.5" required>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button"
                        onclick="document.getElementById('modalPekerjaan').classList.add('hidden')"
                        class="px-4 py-2 bg-gray-100 rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endif
