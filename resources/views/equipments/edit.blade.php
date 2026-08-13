<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">

            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Edit Data Equipment </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Manajemen data peralatan dan alat kerja konstruksi
                </p>
            </div>

        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Card Form Utama -->
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-xl border border-gray-100 p-6 md:p-8">
                
                <form action="{{ route('equipments.update', $equipment->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Input: Nama Alat -->
                    <div class="space-y-1.5">
                        <label for="nama_alat" class="text-xs font-bold text-slate-700 uppercase tracking-wide block">
                            Nama Alat <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                               id="nama_alat"
                               name="nama_alat" 
                               value="{{ old('nama_alat', $equipment->nama_alat) }}"
                               class="w-full text-sm text-slate-800 bg-white border @error('nama_alat') border-rose-300 focus:border-rose-400 focus:ring-rose-100 @else border-slate-200 focus:border-indigo-400 focus:ring-indigo-100 @enderror rounded-lg px-3.5 py-2.5 transition duration-150 focus:outline-none focus:ring-3"
                               required>
                        @error('nama_alat')
                            <p class="text-xs font-medium text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Grid untuk Satuan dan Harga -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        
                        <!-- Input: Satuan -->
                        <div class="space-y-1.5 md:col-span-1">
                            <label for="satuan" class="text-xs font-bold text-slate-700 uppercase tracking-wide block">
                                Satuan <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" 
                                   id="satuan"
                                   name="satuan" 
                                   value="{{ old('satuan', $equipment->satuan) }}"
                                   class="w-full text-sm text-slate-800 bg-white border @error('satuan') border-rose-300 focus:border-rose-400 focus:ring-rose-100 @else border-slate-200 focus:border-indigo-400 focus:ring-indigo-100 @enderror rounded-lg px-3.5 py-2.5 transition duration-150 focus:outline-none focus:ring-3"
                                   required>
                            @error('satuan')
                                <p class="text-xs font-medium text-rose-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Input: Harga Satuan -->
                        <div class="space-y-1.5 md:col-span-2">
                            <label for="harga_satuan" class="text-xs font-bold text-slate-700 uppercase tracking-wide block">
                                Harga Satuan (Rp) <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative rounded-lg shadow-xs">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <span class="text-slate-400 text-sm font-semibold">Rp</span>
                                </div>
                                <input type="number" 
                                       id="harga_satuan"
                                       name="harga_satuan" 
                                       value="{{ old('harga_satuan', $equipment->harga_satuan) }}"
                                       min="0"
                                       class="w-full text-sm text-slate-800 bg-white border @error('harga_satuan') border-rose-300 focus:border-rose-400 focus:ring-rose-100 @else border-slate-200 focus:border-indigo-400 focus:ring-indigo-100 @enderror rounded-lg pl-10 pr-3.5 py-2.5 transition duration-150 focus:outline-none focus:ring-3"
                                       required>
                            </div>
                            @error('harga_satuan')
                                <p class="text-xs font-medium text-rose-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Tombol Aksi Akhir -->
                    <div class="mt-8 pt-6 flex items-center justify-end gap-3 border-t border-slate-100">
                        <x-secondary-button type="button" onclick="window.location='{{ route('equipments.index') }}'">
                            {{ __('Batal') }}
                        </x-secondary-button>

                        <button type="submit"
                                class="inline-flex items-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white text-xs font-semibold uppercase tracking-widest rounded-md shadow-xs transition duration-150">
                            {{ __('Update Alat') }}
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>