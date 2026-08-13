{{-- RENCANA ANGGARAN BIAYA --}}
@if ($audit->rab)
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h3 class="text-xl font-bold text-slate-800">Rencana Anggaran Biaya (RAB)</h3>
                <p class="text-sm text-slate-500 mt-1">Detail estimasi biaya berdasarkan pekerjaan AHSP.</p>
            </div>
            <button onclick="document.getElementById('modalPekerjaan').classList.remove('hidden')"
                class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow">
                + Tambah Pekerjaan
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b text-xs uppercase text-slate-400">
                        <th class="text-left py-4">No</th>
                        <th class="text-left py-4">Pekerjaan</th>
                        <th class="text-center py-4">Volume</th>
                        <th class="text-right py-4">Harga Satuan</th>
                        <th class="text-right py-4">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($audit->rab->details as $detail)
                        <tr class="hover:bg-slate-50">
                            <td class="py-4">{{ $loop->iteration }}</td>
                            <td class="py-4 font-medium">{{ $detail->ahsp->nama_pekerjaan }}</td>
                            <td class="py-4 text-center">{{ $detail->volume }}</td>
                            <td class="py-4 text-right">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                            <td class="py-4 text-right font-bold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-slate-400">Belum ada pekerjaan RAB.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-8 bg-slate-50 rounded-2xl p-6 flex justify-between items-center">
            <div>
                <p class="text-xs uppercase text-slate-400">Total Estimasi Biaya</p>
                <p class="text-3xl font-bold text-slate-900 mt-2">Rp {{ number_format($audit->rab->total_biaya, 0, ',', '.') }}</p>
            </div>
            <div class="hidden md:block">
                <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 10v-1" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
@endif
{{-- MODAL TAMBAH PEKERJAAN --}}
@if ($audit->rab)
    <div id="modalPekerjaan" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center px-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-xl p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold">Tambah Pekerjaan RAB</h3>
                <button onclick="document.getElementById('modalPekerjaan').classList.add('hidden')"
                    class="text-slate-400 hover:text-red-600 text-2xl">×</button>
            </div>
            <form action="{{ route('rab-details.store') }}" method="POST">
                @csrf
                <input type="hidden" name="rab_id" value="{{ $audit->rab->id }}">
                <div class="mb-5">
                    <label class="block text-sm font-semibold mb-2">
                        Pilih Pekerjaan <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span>
                    </label>
                    <select name="ahsp_id" class="w-full border rounded-xl p-3" required>
                        <option value="">-- Pilih AHSP --</option>
                        @foreach ($ahsps as $ahsp)
                            <option value="{{ $ahsp->id }}">{{ $ahsp->kode }} - {{ $ahsp->nama_pekerjaan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2">
                        Volume <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span>
                    </label>
                    <input type="number" step="0.01" min="1" name="volume" class="w-full border rounded-xl p-3" required>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button"
                        onclick="document.getElementById('modalPekerjaan').classList.add('hidden')"
                        class="px-5 py-2 rounded-xl bg-slate-200">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-blue-600 text-white">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endif
