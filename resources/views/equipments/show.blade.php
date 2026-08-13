<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">

            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Detail Data Equipment </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Manajemen data peralatan dan alat kerja konstruksi
                </p>
            </div>

        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-xl border border-gray-100 p-6 md:p-8">
                <h3 class="text-sm font-bold text-gray-400 tracking-wide uppercase mb-6">Informasi Alat</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <!-- Kode -->
                    <div class="p-4 bg-slate-50/60 rounded-lg border border-slate-100 space-y-1">
                        <span class="text-xs font-semibold text-slate-500 uppercase">Kode Alat</span>
                        <div class="text-base font-bold text-slate-800">{{ $equipment->kode }}</div>
                    </div>

                    <!-- Nama Alat -->
                    <div class="p-4 bg-slate-50/60 rounded-lg border border-slate-100 space-y-1">
                        <span class="text-xs font-semibold text-slate-500 uppercase">Nama Alat</span>
                        <div class="text-base font-semibold text-slate-900">{{ $equipment->nama_alat }}</div>
                    </div>

                    <!-- Satuan -->
                    <div class="p-4 bg-slate-50/60 rounded-lg border border-slate-100 space-y-1">
                        <span class="text-xs font-semibold text-slate-500 uppercase">Satuan</span>
                        <div class="text-base text-slate-700">{{ $equipment->satuan }}</div>
                    </div>

                    <!-- Harga -->
                    <div class="p-4 bg-slate-50/60 rounded-lg border border-slate-100 space-y-1">
                        <span class="text-xs font-semibold text-slate-500 uppercase">Harga Satuan</span>
                        <div class="text-base font-bold text-indigo-600">
                            Rp {{ number_format($equipment->harga_satuan, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-8 pt-6 flex justify-end gap-3 border-t border-slate-100">
                    <x-secondary-button onclick="window.location='{{ route('equipments.index') }}'">
                        {{ __('Kembali') }}
                    </x-secondary-button>

                    <a href="{{ route('equipments.edit', $equipment->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold uppercase tracking-widest rounded-md shadow-xs transition duration-150">
                        {{ __('Edit Data') }}
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>