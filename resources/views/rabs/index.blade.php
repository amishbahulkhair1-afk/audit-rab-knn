<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Data Rencana Anggaran Biaya (RAB)
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Daftar seluruh Rencana Anggaran Biaya hasil audit bangunan.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr class="text-left">
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                    No
                                </th>

                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Nomor RAB
                                </th>

                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Tanggal
                                </th>

                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Total Biaya
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse($rabs as $rab)

                                <tr class="hover:bg-slate-50 transition">

                                    <td class="px-6 py-4 text-sm text-slate-500">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="font-semibold text-slate-500">
                                            {{ $rab->nomor_rab }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-slate-500">
                                        {{ \Carbon\Carbon::parse($rab->tanggal_rab)->translatedFormat('d F Y') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="font-semibold text-emerald-500">
                                            Rp {{ number_format($rab->total_biaya,0,',','.') }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">

                                        <a href="{{ route('rabs.show',$rab) }}"
                                           class="inline-flex items-center px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition">

                                            Detail

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5"
                                        class="px-6 py-12 text-center text-slate-400">

                                        Belum ada data RAB.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>

                @if($rabs instanceof \Illuminate\Contracts\Pagination\Paginator && $rabs->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
                        {{ $rabs->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>