<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-slate-800">
            Tambah Material Baru
        </h2>

    </x-slot>

    <div class="py-10">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-xl border border-slate-100 overflow-hidden">

                <!-- HEADER -->

                <div class="px-6 py-5 bg-slate-50 border-b border-slate-100">

                    <h3 class="text-lg font-bold text-slate-800">

                        Form Input Material

                    </h3>

                    <p class="text-sm text-slate-500 mt-1">

                        Tambahkan data bahan material baru untuk kebutuhan RAB.

                    </p>

                </div>

                <!-- FORM -->

                <div class="p-6 md:p-8">

                    <form action="{{ route('materials.store') }}" method="POST" class="space-y-6">

                        @csrf

                        <!-- Nama Bahan -->

                        <div>

                            <label class="block text-xs font-bold uppercase tracking-wide text-slate-700 mb-2">

                                Nama Bahan

                                <span class="text-rose-500">*</span>

                            </label>

                            <input type="text" name="nama_bahan" value="{{ old('nama_bahan') }}"
                                placeholder="Contoh: Semen Portland"
                                class="w-full rounded-lg border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-200"
                                required>

                            @error('nama_bahan')
                                <p class="text-xs text-rose-600 mt-1">

                                    {{ $message }}

                                </p>
                            @enderror

                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Satuan -->

                            <div>

                                <label class="block text-xs font-bold uppercase tracking-wide text-slate-700 mb-2">

                                    Satuan

                                    <span class="text-rose-500">*</span>

                                </label>

                                <input type="text" name="satuan" value="{{ old('satuan') }}"
                                    placeholder="Contoh: Sak, Kg, M3"
                                    class="w-full rounded-lg border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-200"
                                    required>

                                @error('satuan')
                                    <p class="text-xs text-rose-600 mt-1">

                                        {{ $message }}

                                    </p>
                                @enderror

                            </div>

                            <!-- Harga -->

                            <div>

                                <label class="block text-xs font-bold uppercase tracking-wide text-slate-700 mb-2">

                                    Harga Satuan

                                    <span class="text-rose-500">*</span>

                                </label>

                                <div class="relative">

                                    <span class="absolute left-3 top-2.5 text-sm font-semibold text-slate-400">

                                        Rp

                                    </span>

                                    <input type="number" name="harga_satuan" value="{{ old('harga_satuan') }}"
                                        min="0" placeholder="0"
                                        class="w-full rounded-lg border-slate-300 text-sm pl-10 focus:border-indigo-500 focus:ring-indigo-200"
                                        required>

                                </div>

                                @error('harga_satuan')
                                    <p class="text-xs text-rose-600 mt-1">

                                        {{ $message }}

                                    </p>
                                @enderror

                            </div>

                        </div>

                        <!-- Keterangan -->

                        <div>

                            <label class="block text-xs font-bold uppercase tracking-wide text-slate-700 mb-2">

                                Keterangan

                            </label>

                            <textarea name="keterangan" rows="4" placeholder="Tambahkan detail atau spesifikasi material..."
                                class="w-full rounded-lg border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-200">{{ old('keterangan') }}</textarea>

                            @error('keterangan')
                                <p class="text-xs text-rose-600 mt-1">

                                    {{ $message }}

                                </p>
                            @enderror

                        </div>

                        <!-- BUTTON -->

                        <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">

                            <a href="{{ route('materials.index') }}"
                                class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-lg transition">

                                Batal

                            </a>

                            <button type="submit"
                                class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">

                                Simpan Material

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
