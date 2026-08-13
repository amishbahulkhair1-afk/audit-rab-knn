@extends('layouts.user')

@section('content')
    <div class="py-10">
        <div class="max-w-4xl mx-auto">

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-slate-900">{{ __('Audit Bangunan') }}</h2>
                <p class="text-sm text-slate-500 mt-1">
                    {{ __('Lakukan penilaian kondisi komponen bangunan untuk proses klasifikasi.') }}</p>
            </div>

            <form action="{{ route('audits.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Section: Data Bangunan -->
                <div class="bg-white p-8 shadow-xs sm:rounded-xl border border-slate-100">
                    <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-2">
                        {{ __('Pilih Bangunan') }} <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span>
                    </label>
                    <select name="building_id"
                        class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                        {{ $selectedBuilding ? 'disabled' : '' }} required>
                        <option value="">{{ __('Pilih Bangunan...') }}</option>
                        @foreach ($buildings as $building)
                            <option value="{{ $building->id }}"
                                {{ $selectedBuilding && $selectedBuilding->id == $building->id ? 'selected' : '' }}>
                                {{ $building->nama_bangunan }}
                            </option>
                        @endforeach
                    </select>
                    @if ($selectedBuilding)
                        <input type="hidden" name="building_id" value="{{ $selectedBuilding->id }}">
                    @endif
                </div>

                <!-- Section: Komponen & Penilaian -->
                <div class="bg-white p-8 shadow-xs sm:rounded-xl border border-slate-100">
                    <div class="mb-6">
                        <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-2">
                            {{ __('Tanggal Audit') }} <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span>
                        </label>
                        <input type="date" name="tanggal_audit" value="{{ date('Y-m-d') }}"
                            class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @php
                            $komponen = [
                                'pondasi' => 'Pondasi',
                                'struktur' => 'Struktur',
                                'atap' => 'Atap',
                                'dinding' => 'Dinding',
                                'lantai' => 'Lantai',
                                'plafon' => 'Plafon',
                                'pintu' => 'Pintu',
                                'jendela' => 'Jendela',
                                'listrik' => 'Listrik',
                                'sanitasi' => 'Sanitasi',
                            ];
                        @endphp

                        @foreach ($komponen as $name => $label)
                            <div class="space-y-1.5">
                                <label class="block text-xs font-semibold text-slate-700">{{ $label }} <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span></label>
                                <select name="{{ $name }}"
                                    class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                    required>
                                    <option value="">{{ __('Pilih Nilai...') }}</option>
                                    <option value="1">1 - Rusak Berat</option>
                                    <option value="2">2 - Rusak Sedang</option>
                                    <option value="3">3 - Rusak Ringan</option>
                                    <option value="4">4 - Baik</option>
                                    <option value="5">5 - Sangat Baik</option>
                                </select>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider mb-2">
                            {{ __('Catatan Audit') }}
                        </label>
                        <textarea name="catatan" rows="3"
                            class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            placeholder="Tambahkan catatan tambahan..."></textarea>
                    </div>
                </div>

                <!-- Action -->
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="px-8 py-3 bg-emerald-600 text-white text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-emerald-700 shadow-sm transition">
                        {{ __('Proses Audit KNN') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
