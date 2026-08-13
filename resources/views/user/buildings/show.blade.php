@extends('layouts.user')

@section('content')
    <div class="max-w-6xl mx-auto py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Detail Bangunan</h2>
                <p class="text-slate-500 text-sm">Informasi lengkap dan riwayat audit {{ $building->nama_bangunan }}</p>
            </div>
            <a href="{{ route('buildings.index') }}"
                class="bg-slate-200 text-slate-700 px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-slate-300 transition">
                Kembali
            </a>
        </div>

        <!-- Informasi Utama -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 mb-8">
            <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center">
                <span class="w-1.5 h-6 bg-emerald-500 rounded-full mr-3"></span>
                Informasi Bangunan
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Kode &
                        Nama</label>
                    <p class="text-slate-900 font-semibold">{{ $building->kode_bangunan }}</p>
                    <p class="text-slate-600">{{ $building->nama_bangunan }}</p>
                </div>
                <div>
                    <label
                        class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Kategori</label>
                    <p class="text-slate-900">{{ $building->jenis_bangunan }}</p>
                    <p class="text-slate-500 text-sm">{{ $building->jenis_konstruksi }}</p>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Rayon &
                        Luas</label>
                    <p class="text-slate-900">{{ $building->rayon }}</p>
                    <p class="text-slate-600">{{ $building->luas_bangunan }} m²</p>
                </div>
                <div class="md:col-span-3">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Alamat</label>
                    <p class="text-slate-700 bg-slate-50 p-4 rounded-xl border border-slate-100">{{ $building->alamat }}</p>
                </div>
            </div>

            <div class="mt-8 flex gap-3">
                <button onclick="document.getElementById('modalEdit').classList.remove('hidden')"
                    class="bg-amber-500 text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-amber-600 transition shadow-sm">
                    Edit Data
                </button>
                <a href="{{ route('audits.create', ['building_id' => $building->id]) }}"
                    class="bg-emerald-600 text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-emerald-700 transition shadow-sm">
                    + Tambah Audit
                </a>
            </div>
        </div>

        <!-- Riwayat Audit -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-50">
                <h3 class="font-bold text-slate-800">Riwayat Audit</h3>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500 uppercase text-[10px] tracking-widest">
                    <tr>
                        <th class="px-6 py-4 text-left">Tanggal</th>
                        <th class="px-6 py-4 text-left">Kondisi</th>
                        <th class="px-6 py-4 text-left">Hasil KNN</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($building->audits as $audit)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-slate-600">{{ $audit->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $audit->kondisi ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-slate-100 rounded-md text-slate-700 font-medium text-xs">
                                    {{ $audit->knnResult->dataSet->kategori_kerusakan ?? 'Belum diproses' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('audits.show', $audit->id) }}"
                                    class="text-emerald-600 font-semibold hover:underline">Lihat</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-slate-400">Belum ada riwayat audit.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit (Gunakan styling yang sama dengan form baru) -->
    <div id="modalEdit"
        class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl w-full max-w-lg shadow-xl overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-bold text-slate-800">Edit Data Bangunan</h3>
                <button onclick="document.getElementById('modalEdit').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600">✕</button>
            </div>
            <form action="{{ route('buildings.update', $building->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nama Bangunan</label>
                        <input type="text" name="nama_bangunan" value="{{ $building->nama_bangunan }}"
                            class="w-full border border-slate-200 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                    <!-- Tambahkan field lainnya dengan class yang sama -->
                </div>
                <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')"
                        class="px-4 py-2 text-sm font-semibold text-slate-600">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-semibold hover:bg-emerald-700">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
