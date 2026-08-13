<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">

            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Data Biaya Pendukung</h2>

                <p class="text-sm text-slate-500 mt-1">
                    Manajemen biaya tambahan dan kebutuhan pendukung konstruksi
                </p>
            </div>

        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-8 shadow-xs sm:rounded-xl border border-slate-100">
                <form action="{{ route('support-costs.update', $support_cost) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Kode & Nama Biaya -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider">Kode <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span></label>
                            <input type="text" name="kode" value="{{ old('kode', $support_cost->kode) }}"
                                class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                required>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider">Nama Biaya <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span></label>
                            <input type="text" name="nama_biaya"
                                value="{{ old('nama_biaya', $support_cost->nama_biaya) }}"
                                class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                required>
                        </div>
                    </div>

                    <!-- Kategori & Harga -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label
                                class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider">Kategori</label>
                            <select name="kategori"
                                class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                <option value="Transportasi"
                                    {{ $support_cost->kategori == 'Transportasi' ? 'selected' : '' }}>Transportasi
                                </option>
                                <option value="Operasional"
                                    {{ $support_cost->kategori == 'Operasional' ? 'selected' : '' }}>Operasional
                                </option>
                                <option value="Lain-lain"
                                    {{ $support_cost->kategori == 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider">Harga Satuan <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span></label>
                            <input type="number" name="harga_satuan"
                                value="{{ old('harga_satuan', $support_cost->harga_satuan) }}"
                                class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                required>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="space-y-1.5">
                        <label
                            class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                            class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm">{{ old('keterangan', $support_cost->keterangan) }}</textarea>
                    </div>

                    <!-- Actions -->
                    <div class="pt-4 flex justify-end gap-3">
                        <a href="{{ route('support-costs.index') }}"
                            class="px-6 py-2.5 bg-slate-100 text-slate-700 text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-slate-200 transition">
                            {{ __('Batal') }}
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-blue-700 shadow-sm transition">
                            {{ __('Update Data') }}
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
