<x-app-layout>
    <x-slot name="header">Pencarian</x-slot>

    <div class="space-y-6">
        <div class="glass-surface rounded-3xl p-6">
            <h2 class="text-xl font-bold text-slate-900">Hasil pencarian</h2>
            <p class="mt-1 text-sm text-slate-500">
                @if ($q !== '')
                    Menampilkan hasil untuk <span class="font-semibold text-slate-700">“{{ $q }}”</span>.
                @else
                    Masukkan kata kunci untuk mencari data bangunan, audit, atau RAB.
                @endif
            </p>
        </div>

        @if ($q !== '')
            <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
                <section class="rounded-3xl border border-slate-200/70 bg-white p-5 shadow-sm">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="font-bold text-slate-900">Bangunan</h3>
                        <span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-bold text-blue-700">{{ $buildings->count() }}</span>
                    </div>
                    <div class="space-y-3">
                        @forelse ($buildings as $building)
                            <a href="{{ route('buildings.show', $building) }}" class="block rounded-2xl border border-slate-100 p-4 transition hover:border-blue-200 hover:bg-blue-50/50">
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">{{ $building->kode_bangunan }}</p>
                                <p class="mt-1 font-semibold text-slate-800">{{ $building->nama_bangunan }}</p>
                                <p class="mt-1 truncate text-xs text-slate-500">{{ $building->alamat }}</p>
                            </a>
                        @empty
                            <p class="py-6 text-center text-sm text-slate-400">Tidak ada bangunan.</p>
                        @endforelse
                    </div>
                </section>

                <section class="rounded-3xl border border-slate-200/70 bg-white p-5 shadow-sm">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="font-bold text-slate-900">Audit</h3>
                        <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700">{{ $audits->count() }}</span>
                    </div>
                    <div class="space-y-3">
                        @forelse ($audits as $audit)
                            <a href="{{ route('audits.show', $audit) }}" class="block rounded-2xl border border-slate-100 p-4 transition hover:border-emerald-200 hover:bg-emerald-50/50">
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">{{ $audit->nomor_audit }}</p>
                                <p class="mt-1 font-semibold text-slate-800">{{ $audit->building->nama_bangunan ?? '-' }}</p>
                                <p class="mt-1 text-xs text-slate-500">{{ $audit->hasil_knn ?? 'Belum diproses' }}</p>
                            </a>
                        @empty
                            <p class="py-6 text-center text-sm text-slate-400">Tidak ada audit.</p>
                        @endforelse
                    </div>
                </section>

                <section class="rounded-3xl border border-slate-200/70 bg-white p-5 shadow-sm">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="font-bold text-slate-900">RAB</h3>
                        <span class="rounded-full bg-violet-50 px-2.5 py-1 text-xs font-bold text-violet-700">{{ $rabs->count() }}</span>
                    </div>
                    <div class="space-y-3">
                        @forelse ($rabs as $rab)
                            <a href="{{ route('rabs.show', $rab) }}" class="block rounded-2xl border border-slate-100 p-4 transition hover:border-violet-200 hover:bg-violet-50/50">
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">{{ $rab->nomor_rab }}</p>
                                <p class="mt-1 font-semibold text-slate-800">Audit {{ $rab->audit->nomor_audit ?? '-' }}</p>
                                <p class="mt-1 text-xs font-bold text-emerald-600">Rp {{ number_format($rab->total_biaya, 0, ',', '.') }}</p>
                            </a>
                        @empty
                            <p class="py-6 text-center text-sm text-slate-400">Tidak ada RAB.</p>
                        @endforelse
                    </div>
                </section>
            </div>
        @endif
    </div>
</x-app-layout>
