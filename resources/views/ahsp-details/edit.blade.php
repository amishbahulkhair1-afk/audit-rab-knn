<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Detail AHSP
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto">

            <form action="{{ route('ahsp-details.update', $detail->id) }}" method="POST"
                class="bg-white p-6 rounded shadow">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        AHSP
                    </label>
                    <select name="ahsp_id" class="w-full border rounded p-2">
                        @foreach ($ahsps as $ahsp)
                            <option value="{{ $ahsp->id }}" {{ $detail->ahsp_id == $ahsp->id ? 'selected' : '' }}>
                                {{ $ahsp->kode }} - {{ $ahsp->nama_pekerjaan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Bagian Jenis dengan Pilihan Reaktif -->
                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        Jenis
                    </label>
                    <!-- v-model diikat ke state, dan kita isi nilai defaultnya dari database -->
                    <select name="jenis" v-model="jenisTerpilih" class="w-full border rounded p-2">
                        <option value="material">Material</option>
                        <option value="labor">Labor</option>
                        <option value="equipment">Equipment</option>
                    </select>
                </div>

                <!-- Di sini kamu bisa menerapkan drop-down data spesifik berbasis v-if
                 seperti pada form create sebelumnya jika Item ID ingin diubah menjadi select option -->
                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        Item ID
                    </label>
                    <input type="number" name="item_id" value="{{ $detail->item_id }}"
                        class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        Koefisien
                    </label>
                    <input type="number" step="0.0001" name="koefisien" value="{{ $detail->koefisien }}"
                        class="w-full border rounded p-2">
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('ahsp-details.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                        Kembali
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>
