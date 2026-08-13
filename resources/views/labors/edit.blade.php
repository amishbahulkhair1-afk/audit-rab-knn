<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">

            <div>

                <h2 class="font-bold text-xl text-slate-800 leading-tight">
                    {{ __('Edit Data Upah') }}
                </h2>

                <p class="text-xs text-slate-500 mt-1">
                    Perbarui informasi standar biaya tenaga kerja konstruksi
                </p>

            </div>
        </div>

    </x-slot>

    <div class="py-10">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

                <!-- Header Card -->

                <div class="px-6 py-5 bg-slate-50 border-b border-slate-100">

                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-500">

                        Form Perubahan Data Pekerja

                    </h3>

                </div>

                <div class="p-6 md:p-8">

                    <form action="{{ route('labors.update', $labor->id) }}" method="POST" class="space-y-6">

                        @csrf
                        @method('PUT')

                        {{-- Nama Pekerja --}}

                        <div>

                            <label for="nama_pekerja"
                                class="block text-xs font-bold uppercase tracking-wide text-slate-700 mb-2">

                                Nama Pekerja

                                <span class="text-rose-500">*</span>

                            </label>

                            <input type="text" id="nama_pekerja" name="nama_pekerja"
                                value="{{ old('nama_pekerja', $labor->nama_pekerja) }}"
                                placeholder="Contoh: Tukang Batu, Mandor, Tukang Kayu"
                                class="w-full rounded-xl border @error('nama_pekerja') border-rose-300 focus:ring-rose-100 @else border-slate-200 focus:ring-indigo-100 @enderror px-4 py-3 text-sm text-slate-800 focus:border-indigo-400 focus:ring-4 transition"
                                required>

                            @error('nama_pekerja')
                                <p class="mt-1 text-xs text-rose-600 font-medium">

                                    {{ $message }}

                                </p>
                            @enderror

                        </div>

                        {{-- Upah Harian --}}

                        <div>

                            <label for="upah_harian"
                                class="block text-xs font-bold uppercase tracking-wide text-slate-700 mb-2">

                                Upah Harian (Rp)

                                <span class="text-rose-500">*</span>

                            </label>

                            <div class="relative">

                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                                    <span class="text-sm font-semibold text-slate-400">

                                        Rp

                                    </span>

                                </div>

                                <input type="number" id="upah_harian" name="upah_harian"
                                    value="{{ old('upah_harian', $labor->upah_harian) }}" min="0" placeholder="0"
                                    class="w-full rounded-xl border @error('upah_harian') border-rose-300 focus:ring-rose-100 @else border-slate-200 focus:ring-indigo-100 @enderror pl-12 pr-4 py-3 text-sm text-slate-800 focus:border-indigo-400 focus:ring-4 transition"
                                    required>

                            </div>

                            @error('upah_harian')
                                <p class="mt-1 text-xs text-rose-600 font-medium">

                                    {{ $message }}

                                </p>
                            @enderror

                        </div>

                        {{-- Preview Upah --}}

                        <div class="p-4 rounded-xl bg-indigo-50 border border-indigo-100">

                            <p class="text-xs font-bold uppercase text-indigo-400">

                                Nilai Saat Ini

                            </p>

                            <p class="mt-1 text-xl font-bold text-indigo-700">

                                Rp
                                {{ number_format($labor->upah_harian, 0, ',', '.') }}

                            </p>

                        </div>

                        {{-- Button --}}

                        <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">

                            <a href="{{ route('labors.index') }}"
                                class="inline-flex items-center px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-lg transition">

                                Batal

                            </a>

                            <button type="submit"
                                class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg shadow-sm transition">

                                Update Data

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
