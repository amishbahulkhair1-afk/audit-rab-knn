<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Detail RAB
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Informasi rincian Rencana Anggaran Biaya bangunan.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto px-6 space-y-6">

            {{-- ===========================
            INFORMASI RAB
            ============================ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200">

                <div class="px-6 py-5 border-b border-slate-200">

                    <h3 class="text-lg font-bold text-slate-800">
                        Informasi RAB
                    </h3>

                </div>

                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                        <div>
                            <p class="text-xs uppercase font-semibold text-slate-400">
                                Nama Bangunan
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-800">
                                {{ $rab->audit->building->nama_bangunan }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs uppercase font-semibold text-slate-400">
                                Nomor RAB
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-800">
                                {{ $rab->nomor_rab }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs uppercase font-semibold text-slate-400">
                                Tanggal
                            </p>

                            <p class="mt-1 text-sm text-slate-700">
                                {{ \Carbon\Carbon::parse($rab->tanggal_rab)->translatedFormat('d F Y') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs uppercase font-semibold text-slate-400">
                                Total Biaya
                            </p>

                            <p class="mt-1 text-xl font-bold text-emerald-600">
                                Rp {{ number_format($rab->total_biaya,0,',','.') }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>



            {{-- ===========================
            DETAIL PEKERJAAN
            ============================ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-200">

                    <h3 class="text-lg font-bold text-slate-800">

                        Detail Pekerjaan

                    </h3>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-slate-50">

                            <tr class="text-xs uppercase tracking-wider text-slate-500">

                                <th class="px-6 py-4 text-left">
                                    No
                                </th>

                                <th class="px-6 py-4 text-left">
                                    Nama Pekerjaan
                                </th>

                                <th class="px-6 py-4 text-center">
                                    Volume
                                </th>

                                <th class="px-6 py-4 text-right">
                                    Harga Satuan
                                </th>

                                <th class="px-6 py-4 text-right">
                                    Subtotal
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse($rab->details as $detail)

                                <tr class="hover:bg-slate-50 transition">

                                    <td class="px-6 py-4">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4 font-medium text-slate-800">
                                        {{ $detail->ahsp->nama_pekerjaan }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        {{ $detail->volume }}
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        Rp {{ number_format($detail->harga_satuan,0,',','.') }}
                                    </td>

                                    <td class="px-6 py-4 text-right font-semibold text-slate-800">
                                        Rp {{ number_format($detail->subtotal,0,',','.') }}
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5"
                                        class="text-center py-10 text-slate-500">

                                        Belum ada rincian pekerjaan.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                        @if($rab->details->count())

                        <tfoot class="bg-slate-50">

                            <tr>

                                <td colspan="4"
                                    class="px-6 py-4 text-right font-bold">

                                    TOTAL

                                </td>

                                <td class="px-6 py-4 text-right">

                                    <span class="text-lg font-bold text-emerald-600">

                                        Rp {{ number_format($rab->total_biaya,0,',','.') }}

                                    </span>

                                </td>

                            </tr>

                        </tfoot>

                        @endif

                    </table>

                </div>

            </div>



            {{-- ===========================
            ACTION
            ============================ --}}
            <div class="flex justify-end">

                <a href="{{ route('rabs.index') }}"
                    class="inline-flex items-center px-5 py-2.5
                           bg-slate-700 hover:bg-slate-800
                           text-white rounded-xl transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-2"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"/>

                    </svg>

                    Kembali

                </a>

            </div>

        </div>

    </div>

</x-app-layout>