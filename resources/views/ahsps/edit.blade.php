<x-app-layout>

<x-slot name="header">

        <div class="w-full flex justify-between items-center">

            {{-- Judul --}}
            <div>

                <h2 class="font-bold text-2xl text-slate-900">
                    Edit Analisis Harga Satuan Pekerjaan (AHSP)
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Manajemen standar analisis pekerjaan konstruksi dan komponen RAB
                </p>

            </div>


        </div>


    </x-slot>

<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">

            <!-- PANGGIL FORM VUE REUSABLE DALAM MODE EDIT -->
            <form-ahsp 
                url-action="{{ route('ahsps.update', $ahsp->id) }}" 
                csrf-token="{{ csrf_token() }}"
                :data-lama='@json($ahsp->load('details'))'
                :is-edit="true"
            ></form-ahsp>

        </div>
    </div>
</div>

</x-app-layout>