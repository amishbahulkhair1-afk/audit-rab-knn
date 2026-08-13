<x-app-layout>

    <x-slot name="header">

        <div class="w-full flex justify-between items-center">

            {{-- Judul --}}
            <div>

                <h2 class="font-bold text-xl text-slate-900 tracking-tight">
                    Manajemen Audit Bangunan
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Kelola pemeriksaan kondisi bangunan dan hasil klasifikasi KNN.
                </p>

            </div>

            {{-- Button Tambah Audit --}}
            <div>

                <a href="{{ route('audits.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-500 text-white font-semibold shadow-md hover:shadow-lg transition">

                    {{-- Hero Icon Plus --}}

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                    </svg>

                    Audit Baru

                </a>

            </div>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- SUCCESS MESSAGE --}}

            @if (session('success'))
                <div
                    class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-2xl">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />

                    </svg>

                    <span class="font-semibold">

                        {{ session('success') }}

                    </span>

                </div>
            @endif

            {{-- TABLE CARD --}}

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr
                                class="bg-slate-50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-500">

                                <th class="px-4 py-3 text-left">

                                    Nomor Audit

                                </th>

                                <th class="px-4 py-3 text-left">

                                    Tanggal

                                </th>

                                <th class="px-4 py-3 text-left">

                                    Bangunan

                                </th>

                                <th class="px-4 py-3 text-left">

                                    Konstruksi

                                </th>

                                <th class="px-4 py-3 text-left">

                                    Hasil KNN

                                </th>

                                <th class="px-4 py-3 text-center">

                                    Aksi

                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse($audits as $audit)
                                <tr class="hover:bg-slate-50 transition">

                                    <td class="px-4 py-3">

                                        <span class="font-mono font-semibold text-slate-600">

                                            {{ $audit->nomor_audit }}

                                        </span>

                                    </td>

                                    <td class="px-4 py-3 text-sm text-slate-600">

                                        {{ \Carbon\Carbon::parse($audit->tanggal_audit)->translatedFormat('d M Y') }}

                                    </td>

                                    <td class="px-4 py-3">

                                        <p class="font-semibold text-slate-400">

                                            {{ $audit->building->nama_bangunan ?? '-' }}

                                        </p>

                                    </td>

                                    <td class="px-4 py-3">

                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">

                                            {{ $audit->building->jenis_konstruksi ?? '-' }}

                                        </span>

                                    </td>

                                    {{-- HASIL KNN --}}

                                    <td class="px-4 py-3">

                                        @if ($audit->hasil_knn)
                                            @php

                                                $hasil = strtolower($audit->hasil_knn);

                                                if (str_contains($hasil, 'layak') || str_contains($hasil, 'baik')) {
                                                    $style = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                                } elseif (str_contains($hasil, 'kurang')) {
                                                    $style = 'bg-amber-50 text-amber-700 border-amber-200';
                                                } else {
                                                    $style = 'bg-rose-50 text-rose-700 border-rose-200';
                                                }

                                            @endphp

                                            <span
                                                class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold border {{ $style }}">

                                                <span class="w-2 h-2 rounded-full bg-current"></span>

                                                {{ $audit->hasil_knn }}

                                            </span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs bg-slate-100 text-slate-500">

                                                Belum Diproses

                                            </span>
                                        @endif

                                    </td>

                                    {{-- DETAIL --}}

                                    <td class="px-6 py-4 text-center">

                                        <a href="{{ route('audits.show', $audit) }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-50 text-blue-600 text-xs font-bold hover:bg-blue-100 transition">

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">

                                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                                            </svg>

                                            Detail

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="text-center py-12 text-slate-400">

                                        Belum ada data audit.

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- PAGINATION --}}

                @if ($audits->hasPages())
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">

                        {{ $audits->links() }}

                    </div>
                @endif

            </div>

        </div>

    </div>

</x-app-layout>
