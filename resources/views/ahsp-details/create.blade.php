<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Detail AHSP
        </h2>
    </x-slot>

    <!-- Kita bungkus form ini dengan komponen Vue inline menggunakan x-data atau biarkan dibaca oleh Vue global -->
    <div class="py-6">
        <div class="max-w-4xl mx-auto">

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Gunakan komponen Vue pembungkus runtime jika dibutuhkan, atau manfaatkan keaktifan Vue dari #app -->
            <form method="POST" action="{{ route('ahsp-details.store') }}" class="bg-white p-6 rounded shadow"
                v-data="{ jenisTerpilih: '' }">
                <!-- Menggunakan attribute reaktif Vue internal di elemen jika diisi via app.js -->

                @csrf

                <div class="mb-4">
                    <label class="block mb-2 font-medium">AHSP</label>
                    <input type="text" value="{{ $ahsp->kode }} - {{ $ahsp->nama_pekerjaan }}"
                        class="w-full border rounded p-2 bg-gray-100" readonly>
                    <input type="hidden" name="ahsp_id" value="{{ $ahsp->id }}">
                </div>

                <!-- Input Dropdown Jenis (Kunci Utamanya di sini) -->
                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        Jenis
                    </label>
                    <!-- Kita ikat value select ini ke variabel Vue 'jenisTerpilih' menggunakan v-model -->
                    <select name="jenis" v-model="jenisTerpilih" class="w-full border rounded p-2">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="material">Material</option>
                        <option value="labor">Labor</option>
                        <option value="equipment">Equipment</option>
                        <option value="support_cost">Biaya Pendukung</option>
                    </select>
                </div>

                <!-- Box Pilihan Material -->
                <div class="mb-4" v-if="jenisTerpilih === 'material'">
                    <label class="block mb-2 font-medium">
                        Material
                    </label>
                    <select name="material_id" class="w-full border rounded p-2">
                        <option value="">-- Pilih Material --</option>
                        @foreach ($materials as $material)
                            <option value="{{ $material->id }}">
                                {{ $material->kode }} - {{ $material->nama_bahan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Box Pilihan Tenaga Kerja -->
                <div class="mb-4" v-if="jenisTerpilih === 'labor'">
                    <label class="block mb-2 font-medium">
                        Tenaga Kerja
                    </label>
                    <select name="labor_id" class="w-full border rounded p-2">
                        <option value="">-- Pilih Tenaga Kerja --</option>
                        @foreach ($labors as $labor)
                            <option value="{{ $labor->id }}">
                                {{ $labor->kode }} - {{ $labor->nama_pekerja }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Box Pilihan Peralatan -->
                <div class="mb-4" v-if="jenisTerpilih === 'equipment'">
                    <label class="block mb-2 font-medium">
                        Peralatan
                    </label>
                    <select name="equipment_id" class="w-full border rounded p-2">
                        <option value="">-- Pilih Peralatan --</option>
                        @foreach ($equipments as $equipment)
                            <option value="{{ $equipment->id }}">
                                {{ $equipment->kode }} - {{ $equipment->nama_alat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Box Pilihan Biaya Pendukung -->
                <div class="mb-4" v-if="jenisTerpilih === 'support_cost'">
                    <label class="block mb-2 font-medium">
                        Biaya Pendukung
                    </label>
                    <select name="support_cost_id" class="w-full border rounded p-2">
                        <option value="">-- Pilih Biaya Pendukung --</option>
                        @foreach ($supportCosts as $support)
                            <option value="{{ $support->id }}">
                                {{ $support->kode }} - {{ $support->nama_biaya }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        Koefisien
                    </label>
                    <input type="number" step="0.0001" name="koefisien" class="w-full border rounded p-2" required>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('ahsps.show', $ahsp->id) }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                        Kembali
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>
