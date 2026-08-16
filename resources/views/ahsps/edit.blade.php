<x-app-layout>

    <x-slot name="header">
        Edit AHSP
    </x-slot>

    <div class="space-y-5">

        @if ($errors->any())
            <div class="rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700 shadow-sm">
                <p class="font-semibold">AHSP belum dapat diperbarui. Periksa data berikut:</p>
                <ul class="mt-2 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- =========================================
             HERO / HEADER CARD
        ========================================== --}}
        <div
            class="relative overflow-hidden rounded-[28px] bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 p-5 md:p-6 text-white shadow-xl">

            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.18),transparent_45%)]">
            </div>

            <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div class="flex items-start gap-4">

                    <div
                        class="w-14 h-14 rounded-2xl bg-white/15 border border-white/20 backdrop-blur-sm flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-semibold uppercase tracking-[0.35em] text-white/70">
                                Master Data
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full bg-white/20 text-white text-[10px] font-bold font-mono">
                                {{ $ahsp->kode }}
                            </span>
                        </div>
                        <h1 class="text-xl md:text-2xl font-bold leading-tight">
                            Edit: {{ $ahsp->nama_pekerjaan }}
                        </h1>
                        <p class="text-xs md:text-sm text-white/80 mt-1">
                            Perbarui rincian item pekerjaan dan analisis koefisien pembentuk RAB.
                        </p>
                    </div>

                </div>

                <a href="{{ route('ahsps.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white/20 hover:bg-white/30 text-white px-4 py-2.5 text-xs font-semibold backdrop-blur-sm border border-white/20 transition whitespace-nowrap self-start sm:self-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>

            </div>

        </div>

        {{-- =========================================
             FORM CARD (VUE COMPONENT EDIT MODE)
        ========================================== --}}
        <div class="glass-surface rounded-3xl overflow-hidden p-6 md:p-8">

            <form action="{{ route('ahsps.update', $ahsp) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="nama_pekerjaan" class="mb-1 block text-sm font-medium text-slate-700">Nama pekerjaan</label>
                        <input id="nama_pekerjaan" name="nama_pekerjaan" type="text" value="{{ old('nama_pekerjaan', $ahsp->nama_pekerjaan) }}" class="w-full rounded-lg border-slate-300" required>
                    </div>
                    <div>
                        <label for="satuan" class="mb-1 block text-sm font-medium text-slate-700">Satuan</label>
                        <input id="satuan" name="satuan" type="text" value="{{ old('satuan', $ahsp->satuan) }}" class="w-full rounded-lg border-slate-300" required>
                    </div>
                </div>

                <div class="mt-7 border-t border-slate-200 pt-6">
                    <div class="mb-4 flex items-center justify-between gap-3">
                        <div>
                            <h2 class="text-lg font-semibold text-slate-800">Rincian komponen</h2>
                            <p class="text-sm text-slate-500">Tambahkan, ubah, atau hapus komponen AHSP.</p>
                        </div>
                        <button type="button" id="tambah-komponen" class="rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">
                            + Tambah komponen
                        </button>
                    </div>
                    <div id="daftar-komponen" class="space-y-3"></div>
                </div>

                <div class="mt-6 flex justify-end gap-3 border-t border-slate-200 pt-5">
                    <a href="{{ route('ahsps.show', $ahsp) }}" class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-200">Batal</a>
                    <button type="submit" class="rounded-lg bg-emerald-600 px-5 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Simpan Perubahan</button>
                </div>
            </form>

        </div>

    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const masterData = @json($masterData);
                const existingDetails = @json($detailData);
                const daftarKomponen = document.getElementById('daftar-komponen');

                const tambahKomponen = (detail = {}) => {
                    const index = daftarKomponen.children.length;
                    const row = document.createElement('div');
                    row.className = 'grid gap-4 rounded-xl border border-slate-200 bg-slate-50 p-4 md:grid-cols-[minmax(0,1fr)_minmax(0,2fr)_10rem_auto] md:items-end';
                    row.innerHTML = `
                        <input type="hidden" name="details[${index}][id]" value="${detail.id || ''}">
                        <div><label class="mb-1 block text-sm font-medium text-slate-700">Jenis</label><select name="details[${index}][jenis]" class="jenis w-full rounded-lg border-slate-300" required><option value="material">Material</option><option value="labor">Tenaga kerja</option><option value="equipment">Peralatan</option><option value="support_cost">Biaya pendukung</option></select></div>
                        <div><label class="mb-1 block text-sm font-medium text-slate-700">Item</label><select name="details[${index}][item_id]" class="item w-full rounded-lg border-slate-300" required></select></div>
                        <div><label class="mb-1 block text-sm font-medium text-slate-700">Koefisien</label><input name="details[${index}][koefisien]" type="number" min="0.0001" step="0.0001" value="${detail.koefisien || 1}" class="w-full rounded-lg border-slate-300" required></div>
                        <button type="button" class="hapus-komponen rounded-lg bg-rose-100 px-3 py-2 text-sm font-semibold text-rose-700 hover:bg-rose-200">Hapus</button>`;

                    const jenis = row.querySelector('.jenis');
                    const item = row.querySelector('.item');
                    jenis.value = detail.jenis || 'material';
                    const isiItem = () => {
                        item.replaceChildren(new Option('-- Pilih item --', ''));
                        masterData[jenis.value].forEach((data) => item.add(new Option(data.label, data.id)));
                        item.value = detail.item_id || '';
                    };
                    jenis.addEventListener('change', () => {
                        detail.item_id = '';
                        isiItem();
                    });
                    row.querySelector('.hapus-komponen').addEventListener('click', () => {
                        if (daftarKomponen.children.length > 1) row.remove();
                    });
                    isiItem();
                    daftarKomponen.append(row);
                };

                existingDetails.forEach(tambahKomponen);
                if (!existingDetails.length) tambahKomponen();
                document.getElementById('tambah-komponen').addEventListener('click', () => tambahKomponen());
            });
        </script>
    @endpush
</x-app-layout>
