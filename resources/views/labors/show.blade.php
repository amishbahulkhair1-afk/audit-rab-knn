<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">

            <div>
                <h2 class="font-bold text-xl text-slate-800 leading-tight">
                    {{ __('Detail Data Pekerja') }}
                </h2>

                <p class="text-xs text-slate-500 mt-1">
                    Informasi detail tenaga kerja konstruksi
                </p>
            </div>

            <span
                class="inline-flex items-center gap-2 px-3 py-1.5 text-xs font-semibold bg-slate-100 text-slate-700 rounded-lg border border-slate-200">

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.29.51 6.121 1.417M15 11a3 3 0 11-6 0 3 3 0 016 0z" />

                </svg>

                ID #{{ $labor->id }}

            </span>

        </div>

    </x-slot>

    <div class="py-10">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

                <!-- Header Card -->

                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50">

                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-500">

                        Informasi Tenaga Kerja

                    </h3>

                </div>

                <!-- Content -->

                <div class="p-6 md:p-8">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Kode -->

                        <div class="p-5 rounded-xl bg-slate-50 border border-slate-100">

                            <div class="flex items-center gap-2 mb-3">

                                <div
                                    class="w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center">

                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 20l4-16m2 16l4-16M6 9h12M4 15h12" />

                                    </svg>

                                </div>

                                <span class="text-xs font-bold uppercase text-slate-400">
                                    Kode Pekerja
                                </span>

                            </div>

                            <p class="text-lg font-bold text-slate-800">

                                {{ $labor->kode }}

                            </p>

                        </div>

                        <!-- Nama -->

                        <div class="p-5 rounded-xl bg-slate-50 border border-slate-100">

                            <div class="flex items-center gap-2 mb-3">

                                <div
                                    class="w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center">

                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />

                                    </svg>

                                </div>

                                <span class="text-xs font-bold uppercase text-slate-400">
                                    Nama Pekerja
                                </span>

                            </div>

                            <p class="text-lg font-semibold text-slate-900">

                                {{ $labor->nama_pekerja }}

                            </p>

                        </div>

                        <!-- Upah -->

                        <div class="md:col-span-2 p-5 rounded-xl bg-indigo-50 border border-indigo-100">

                            <div class="flex items-center gap-2 mb-3">

                                <div
                                    class="w-8 h-8 rounded-lg bg-white border border-indigo-100 flex items-center justify-center">

                                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 10v-1" />

                                    </svg>

                                </div>

                                <span class="text-xs font-bold uppercase text-indigo-400">

                                    Upah Harian

                                </span>

                            </div>

                            <p class="text-2xl font-bold text-indigo-700">

                                Rp {{ number_format($labor->upah_harian, 0, ',', '.') }}

                            </p>

                            <p class="text-xs text-indigo-500 mt-1">

                                Standar biaya tenaga kerja per hari

                            </p>

                        </div>

                    </div>

                    <!-- Action -->

                    <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end gap-3">

                        <a href="{{ route('labors.index') }}"
                            class="inline-flex items-center px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-lg transition">

                            Kembali

                        </a>

                        <a href="{{ route('labors.edit', $labor->id) }}"
                            class="inline-flex items-center px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold rounded-lg shadow-sm transition">

                            Edit Data

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
