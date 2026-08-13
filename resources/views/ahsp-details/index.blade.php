<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Detail AHSP
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- PANGGIL KOMPONEN VUE DI SINI -->
            <tabel-ahsp-detail :data-awal='@json($details->items())'>
                
                <!-- Kita kirim token CSRF Laravel ke dalam form Vue menggunakan slot -->
                <template #form-tokens>
                    @csrf
                    @method('DELETE')
                </template>

            </tabel-ahsp-detail>

            <!-- Pagination bawaan Laravel tetap di luar komponen Vue -->
            <div class="p-4">
                {{ $details->links() }}
            </div>

        </div>
    </div>
</x-app-layout>