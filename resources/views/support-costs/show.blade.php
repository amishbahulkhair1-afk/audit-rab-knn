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
                <div class="space-y-6">

                    <!-- Informasi Utama -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ __('Kode') }}
                            </p>
                            <p class="text-sm font-semibold text-slate-900 mt-1">{{ $support_cost->kode }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                                {{ __('Kategori') }}</p>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 mt-1 rounded-full text-[10px] font-medium bg-slate-100 text-slate-800">
                                {{ $support_cost->kategori }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ __('Nama Biaya') }}
                        </p>
                        <p class="text-sm font-semibold text-slate-900 mt-1">{{ $support_cost->nama_biaya }}</p>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                            {{ __('Harga Satuan') }}</p>
                        <p class="text-sm font-bold text-indigo-600 mt-1 font-mono">Rp
                            {{ number_format($support_cost->harga_satuan, 0, ',', '.') }}</p>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ __('Keterangan') }}
                        </p>
                        <p class="text-sm text-slate-600 mt-1 leading-relaxed italic">
                            {{ $support_cost->keterangan ?? 'Tidak ada keterangan tambahan.' }}
                        </p>
                    </div>

                    <!-- Tombol Navigasi -->
                    <div class="pt-6 border-t border-slate-100 flex gap-3">
                        <a href="{{ route('support-costs.index') }}"
                            class="px-5 py-2.5 bg-slate-100 text-slate-600 text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-slate-200 transition">
                            {{ __('Kembali') }}
                        </a>
                        <a href="{{ route('support-costs.edit', $support_cost) }}"
                            class="px-5 py-2.5 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-blue-700 shadow-sm transition">
                            {{ __('Edit Data') }}
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
