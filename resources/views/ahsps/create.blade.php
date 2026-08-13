<x-app-layout>
    <x-slot name="header">

        <div class="w-full flex justify-between items-center">

            {{-- Judul --}}
            <div>

                <h2 class="font-bold text-2xl text-slate-900">
                    Tambah Analisis Harga Satuan Pekerjaan (AHSP)
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Manajemen standar analisis pekerjaan konstruksi dan komponen RAB
                </p>

            </div>


        </div>


    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <!-- PANGGIL FORM DINAMIS VUE -->
                <form-ahsp url-action="{{ route('ahsps.store') }}" csrf-token="{{ csrf_token() }}"
                    :materials='@json($materials)' :labors='@json($labors)'
                    :equipments='@json($equipments)'
                    :support-costs='@json($supportCosts)'></form-ahsp>

            </div>
        </div>
    </div>
</x-app-layout>
