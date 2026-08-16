<x-app-layout>
    <x-slot name="header">
        Tambah Detail AHSP
    </x-slot>

    <div id="app" class="max-w-5xl mx-auto">

        {{-- Error Alert --}}
        @if ($errors->any())
            <div class="mb-6 rounded-3xl border border-red-200 bg-red-50/90 backdrop-blur-sm p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-red-100 text-red-600">
                        ⚠️
                    </div>

                    <div class="flex-1">
                        <h3 class="text-sm font-semibold text-red-700">
                            Periksa kembali data yang dimasukkan
                        </h3>

                        <ul class="mt-3 list-disc space-y-1 pl-5 text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('ahsp-details.store') }}" class="space-y-6"
            v-scope="{ jenisTerpilih: '{{ old('jenis') }}' }">
            @csrf

            <input type="hidden" name="ahsp_id" value="{{ $ahsp->id }}">

            {{-- =====================================================
             HERO HEADER
        ====================================================== --}}
            <div
                class="relative overflow-hidden rounded-[32px] bg-gradient-to-br from-indigo-500 via-blue-500 to-violet-600 p-8 text-white shadow-2xl shadow-indigo-500/20">

                <div
                    class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.22),transparent_45%)]">
                </div>

                <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                    <div class="flex items-start gap-4">

                        <div
                            class="flex h-16 w-16 items-center justify-center rounded-3xl bg-white/15 backdrop-blur-sm ring-1 ring-white/20">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-medium uppercase tracking-[0.3em] text-indigo-100/90">
                                Analisa Harga Satuan
                            </p>

                            <h1 class="mt-2 text-2xl font-bold leading-tight lg:text-3xl">
                                Tambah Detail AHSP
                            </h1>

                            <p class="mt-2 max-w-2xl text-sm text-indigo-100/90 lg:text-base">
                                Tambahkan komponen material, tenaga kerja, peralatan, atau biaya pendukung untuk menyusun
                                analisa pekerjaan secara lebih akurat.
                            </p>
                        </div>
                    </div>

                    <div class="min-w-[260px] rounded-3xl bg-white/12 p-5 backdrop-blur-sm ring-1 ring-white/15">
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-100/80">
                            AHSP Aktif
                        </p>

                        <p class="mt-3 text-lg font-semibold leading-snug">
                            {{ $ahsp->nama_pekerjaan }}
                        </p>

                        <div
                            class="mt-4 inline-flex items-center gap-2 rounded-2xl bg-white/10 px-3 py-2 text-sm font-medium text-indigo-50 ring-1 ring-white/10">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            {{ $ahsp->kode }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- =====================================================
             INFORMASI AHSP
        ====================================================== --}}
            <ui-card title="Informasi AHSP" description="Detail pekerjaan yang akan ditambahkan komponennya.">

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <div
                        class="rounded-3xl border border-slate-200 bg-slate-50/80 p-5 dark:border-slate-700 dark:bg-slate-800/60">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Kode AHSP
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900 dark:text-slate-100">
                            {{ $ahsp->kode }}
                        </p>
                    </div>

                    <div
                        class="rounded-3xl border border-slate-200 bg-slate-50/80 p-5 dark:border-slate-700 dark:bg-slate-800/60">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Nama Pekerjaan
                        </p>

                        <p class="mt-2 text-lg font-semibold text-slate-900 dark:text-slate-100">
                            {{ $ahsp->nama_pekerjaan }}
                        </p>
                    </div>

                </div>
            </ui-card>

            {{-- =====================================================
             KOMPONEN DETAIL
        ====================================================== --}}
            <ui-card title="Komponen Detail"
                description="Pilih jenis komponen dan tentukan item yang akan digunakan dalam AHSP.">

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    {{-- Jenis --}}
                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-200">
                            Jenis Komponen
                        </label>

                        <ui-select name="jenis" v-model="jenisTerpilih"
                            :options="[
                                { label: 'Material', value: 'material' },
                                { label: 'Tenaga Kerja', value: 'labor' },
                                { label: 'Peralatan', value: 'equipment' },
                                { label: 'Biaya Pendukung', value: 'support_cost' }
                            ]"
                            placeholder="Pilih jenis komponen yang akan ditambahkan" />

                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                            Jenis komponen menentukan daftar data yang tersedia untuk dipilih.
                        </p>
                    </div>

                    {{-- Material --}}
                    <transition name="fade-slide">
                        <div v-if="jenisTerpilih === 'material'" class="md:col-span-2">
                            <div
                                class="rounded-3xl border border-slate-200 bg-slate-50/70 p-5 dark:border-slate-700 dark:bg-slate-800/50">
                                <div class="mb-4 flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-300">
                                        🧱
                                    </div>

                                    <div>
                                        <h3 class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                                            Material
                                        </h3>

                                        <p class="text-xs text-slate-500 dark:text-slate-400">
                                            Pilih material yang digunakan dalam pekerjaan ini.
                                        </p>
                                    </div>
                                </div>

                                <ui-select name="material_id"
                                    :options="[
                                        @foreach ($materials as $material)
                                        {
                                            label: '{{ $material->kode }} - {{ $material->nama_bahan }}',
                                            value: '{{ $material->id }}'
                                        }, @endforeach
                                    ]"
                                    placeholder="Pilih material" />
                            </div>
                        </div>
                    </transition>

                    {{-- Tenaga Kerja --}}
                    <transition name="fade-slide">
                        <div v-if="jenisTerpilih === 'labor'" class="md:col-span-2">
                            <div
                                class="rounded-3xl border border-slate-200 bg-slate-50/70 p-5 dark:border-slate-700 dark:bg-slate-800/50">
                                <div class="mb-4 flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-300">
                                        👷
                                    </div>

                                    <div>
                                        <h3 class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                                            Tenaga Kerja
                                        </h3>

                                        <p class="text-xs text-slate-500 dark:text-slate-400">
                                            Pilih tenaga kerja yang terlibat pada pekerjaan ini.
                                        </p>
                                    </div>
                                </div>

                                <ui-select name="labor_id"
                                    :options="[
                                        @foreach ($labors as $labor)
                                        {
                                            label: '{{ $labor->kode }} - {{ $labor->nama_pekerja }}',
                                            value: '{{ $labor->id }}'
                                        }, @endforeach
                                    ]"
                                    placeholder="Pilih tenaga kerja" />
                            </div>
                        </div>
                    </transition>

                    {{-- Peralatan --}}
                    <transition name="fade-slide">
                        <div v-if="jenisTerpilih === 'equipment'" class="md:col-span-2">
                            <div
                                class="rounded-3xl border border-slate-200 bg-slate-50/70 p-5 dark:border-slate-700 dark:bg-slate-800/50">
                                <div class="mb-4 flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-2xl bg-violet-100 text-violet-600 dark:bg-violet-900/30 dark:text-violet-300">
                                        🛠️
                                    </div>

                                    <div>
                                        <h3 class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                                            Peralatan
                                        </h3>

                                        <p class="text-xs text-slate-500 dark:text-slate-400">
                                            Pilih peralatan yang digunakan dalam pekerjaan ini.
                                        </p>
                                    </div>
                                </div>

                                <ui-select name="equipment_id"
                                    :options="[
                                        @foreach ($equipments as $equipment)
                                        {
                                            label: '{{ $equipment->kode }} - {{ $equipment->nama_alat }}',
                                            value: '{{ $equipment->id }}'
                                        }, @endforeach
                                    ]"
                                    placeholder="Pilih peralatan" />
                            </div>
                        </div>
                    </transition>

                    {{-- Biaya Pendukung --}}
                    <transition name="fade-slide">
                        <div v-if="jenisTerpilih === 'support_cost'" class="md:col-span-2">
                            <div
                                class="rounded-3xl border border-slate-200 bg-slate-50/70 p-5 dark:border-slate-700 dark:bg-slate-800/50">
                                <div class="mb-4 flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-2xl bg-amber-100 text-amber-600 dark:bg-amber-900/30 dark:text-amber-300">
                                        💰
                                    </div>

                                    <div>
                                        <h3 class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                                            Biaya Pendukung
                                        </h3>

                                        <p class="text-xs text-slate-500 dark:text-slate-400">
                                            Pilih biaya pendukung yang relevan untuk pekerjaan ini.
                                        </p>
                                    </div>
                                </div>

                                <ui-select name="support_cost_id"
                                    :options="[
                                        @foreach ($supportCosts as $support)
                                        {
                                            label: '{{ $support->kode }} - {{ $support->nama_biaya }}',
                                            value: '{{ $support->id }}'
                                        }, @endforeach
                                    ]"
                                    placeholder="Pilih biaya pendukung" />
                            </div>
                        </div>
                    </transition>

                    {{-- Koefisien --}}
                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-200">
                            Koefisien
                        </label>

                        <div class="relative">
                            <span
                                class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm font-medium text-slate-400 dark:text-slate-500">
                                x
                            </span>

                            <ui-input type="number" step="0.0001" name="koefisien" value="{{ old('koefisien') }}"
                                placeholder="1.0000" required class="pl-10" />
                        </div>

                        <div
                            class="mt-3 flex flex-col gap-2 rounded-2xl bg-slate-50 p-4 text-xs text-slate-500 dark:bg-slate-800/50 dark:text-slate-400 sm:flex-row sm:items-center sm:justify-between">
                            <span>Gunakan titik (<code>.</code>) sebagai pemisah desimal.</span>
                            <span class="font-medium text-slate-600 dark:text-slate-300">Contoh: 1.2500</span>
                        </div>
                    </div>

                </div>
            </ui-card>

            {{-- =====================================================
             ACTIONS
        ====================================================== --}}
            <div class="sticky bottom-4 z-20">
                <div
                    class="glass-surface rounded-[28px] border border-white/60 p-4 shadow-2xl shadow-slate-200/60 dark:border-slate-700/60 dark:shadow-slate-900/40">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                        <div class="text-sm text-slate-500 dark:text-slate-400">
                            Pastikan jenis komponen dan koefisien sudah sesuai sebelum menyimpan.
                        </div>

                        <div class="flex items-center justify-end gap-3">

                            <a href="{{ route('ahsps.show', $ahsp->id) }}"
                                class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
                                Kembali
                            </a>

                            <ui-button type="submit">
                                <span class="inline-flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Simpan Detail
                                </span>
                            </ui-button>

                        </div>
                    </div>
                </div>
            </div>

        </form>

        <style>
            .fade-slide-enter-active,
            .fade-slide-leave-active {
                transition: all 0.18s ease;
            }

            .fade-slide-enter-from,
            .fade-slide-leave-to {
                opacity: 0;
                transform: translateY(-6px);
            }
        </style>

    </div>
</x-app-layout>
