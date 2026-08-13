<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail AHSP
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <div class="mb-4">
                    <strong class="text-gray-700 block text-sm font-medium">Kode AHSP :</strong>
                    <p class="text-lg font-mono bg-gray-50 p-2 rounded mt-1 border">{{ $detail->ahsp->kode }}</p>
                </div>

                <div class="mb-4">
                    <strong class="text-gray-700 block text-sm font-medium">Nama Pekerjaan :</strong>
                    <p class="text-lg text-gray-900 mt-1">{{ $detail->ahsp->nama_pekerjaan }}</p>
                </div>

                <div class="mb-4">
                    <strong class="text-gray-700 block text-sm font-medium">Jenis :</strong>
                    <p class="text-lg text-gray-900 mt-1">{{ ucfirst($detail->jenis) }}</p>
                </div>

                <div class="mb-4">
                    <strong class="text-gray-700 block text-sm font-medium">Item :</strong>
                    <p class="text-lg text-gray-900 mt-1">{{ $detail->nama_item }}</p>
                </div>

                <div class="mb-4">
                    <strong class="text-gray-700 block text-sm font-medium">Koefisien :</strong>
                    <p class="text-lg font-semibold text-gray-900 mt-1">{{ $detail->koefisien }}</p>
                </div>

                <div class="mt-6 pt-4 border-t">
                    <a href="{{ route('ahsp-details.index') }}"
                        class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded transition shadow-sm">
                        Kembali
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
