<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Sistem Audit Bangunan & RAB
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white p-6 rounded shadow">
                    <h3 class="text-lg font-bold">Data Bangunan</h3>
                    <p class="text-3xl">{{ $totalBangunan }}</p>
                </div>

                <div class="bg-white p-6 rounded shadow">
                    <h3 class="text-lg font-bold">Data Audit</h3>
                    <p class="text-3xl">{{ $totalAudit }}</p>
                </div>

                <div class="bg-white p-6 rounded shadow">
                    <h3 class="text-lg font-bold">Data Latih KNN</h3>
                    <p class="text-3xl">{{ $totalTraining }}</p>
                </div>

                <div class="bg-white p-6 rounded shadow">
                    <h3 class="text-lg font-bold">Data RAB</h3>
                    <p class="text-3xl">{{ $totalRab }}</p>
                </div>

            </div>

        </div>
    </div>
    <div class="mt-8">
    <a href="{{ route('buildings.index') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded">
        Kelola Data Bangunan
    </a>
</div>
</x-app-layout>