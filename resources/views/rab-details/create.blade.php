<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Tambah Pekerjaan RAB') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white p-8 shadow-xs sm:rounded-xl border border-slate-100">
                <form action="{{ route('rab-details.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <input type="hidden" name="rab_id" value="{{ $rab->id }}">

                    <!-- AHSP Select -->
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider">
                            {{ __('Pilih AHSP') }}
                        </label>
                        <select name="ahsp_id" class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @foreach($ahsps as $ahsp)
                                <option value="{{ $ahsp->id }}">{{ $ahsp->nama_pekerjaan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Volume Input -->
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-wider">
                            {{ __('Volume') }}
                        </label>
                        <input type="number" 
                               step="0.01" 
                               name="volume" 
                               required
                               placeholder="0.00"
                               class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    </div>

                    <!-- Actions -->
                    <div class="pt-4 flex justify-end">
                        <button type="submit" 
                                class="px-6 py-2.5 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-blue-700 shadow-sm transition">
                            {{ __('Simpan Pekerjaan') }}
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>