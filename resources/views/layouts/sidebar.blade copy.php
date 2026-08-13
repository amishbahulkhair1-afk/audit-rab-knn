<!-- 1. Tambahkan v-pre di div utama sidebar agar menu navigasi aman dari interferensi Vue -->
<div v-pre class="w-64 bg-slate-800 text-black min-h-screen">

    <div class="p-4 border-b border-slate-700">
        <h2 class="font-bold text-xl text-white"> <!-- Catatan: Teks diganti putih agar kontras dengan bg-slate-800 -->
            Audit KNN & RAB
        </h2>
    </div>

    <nav class="p-4 space-y-2 text-white"> <!-- Catatan: Ditambah text-white agar teks menu terlihat jelas -->
        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-slate-700">
            Dashboard
        </a>
        <a href="{{ route('buildings.index') }}" class="block px-3 py-2 rounded hover:bg-slate-700">
            Data Bangunan
        </a>
        <a href="{{ route('audits.index') }}" class="block px-3 py-2 rounded hover:bg-slate-700">
            Audit Bangunan
        </a>
        <a href="{{ route('rabs.index') }}" class="block px-3 py-2 rounded hover:bg-slate-700">
            RAB
        </a>

        @if(auth()->user()->role == 'admin')
            <hr class="border-slate-600 my-4">
            <h4 class="text-xs text-slate-400 uppercase">Master Data</h4>
            <a href="{{ route('materials.index') }}" class="block px-3 py-2 rounded hover:bg-slate-700">
                Material
            </a>
            <a href="{{ route('labors.index') }}" class="block px-3 py-2 rounded hover:bg-slate-700">
                Tenaga Kerja
            </a>
            <a href="{{ route('equipments.index') }}" class="block px-3 py-2 rounded hover:bg-slate-700">
                Peralatan
            </a>
            <a href="{{ route('support-costs.index') }}" class="block px-3 py-2 rounded hover:bg-slate-700">
                Biaya Pendukung
            </a>
            <a href="{{ route('ahsps.index') }}" class="block px-3 py-2 rounded hover:bg-slate-700">
                AHSP
            </a>
        @endif
    </nav>
</div>

<!-- 2. PENTING: Tambahkan v-pre di sini karena div ini menggunakan Alpine.js intensif (x-data, @click) -->
<div v-pre class="absolute bottom-0 w-64 border-t border-slate-700 p-4 text-white" x-data="{ open: false }">

    <button @click="open = !open" class="w-full text-left p-3 rounded bg-slate-700 hover:bg-slate-600">
        <div class="font-semibold">{{ auth()->user()->name }}</div>
        <div class="text-xs text-slate-300">{{ auth()->user()->role }}</div>
    </button>

    <div x-show="open" @click.away="open = false" x-transition class="mt-2 bg-slate-700 rounded overflow-hidden">
        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-slate-600">
            Profil
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-red-600">
                Logout
            </button>
        </form>
    </div>
</div>