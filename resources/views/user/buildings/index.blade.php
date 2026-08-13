@extends('layouts.user')

@section('content')
    <div class="py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Data Bangunan</h2>
                <p class="text-slate-500 text-sm">Kelola daftar seluruh bangunan dan informasi teknisnya.</p>
            </div>
            <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-emerald-700 transition shadow-sm">
                + Tambah Bangunan
            </button>
        </div>

        <!-- Tabel Data -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 text-slate-600 uppercase text-[10px] tracking-widest">
                        <tr>
                            <th class="px-6 py-4">Nama Bangunan</th>
                            <th class="px-6 py-4">Jenis Konstruksi</th>
                            <th class="px-6 py-4 text-center">Tahun Berdiri</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($buildings as $building)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 font-medium text-slate-900">{{ $building->nama_bangunan }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $building->jenis_konstruksi }}</td>
                                <td class="px-6 py-4 text-center text-slate-600">{{ $building->tahun_berdiri }}</td>
                                <td class="px-6 py-4 text-center space-x-2">
                                    <a href="{{ route('buildings.show', $building->id) }}"
                                        class="text-blue-600 hover:text-blue-800 font-semibold px-2">Detail</a>
                                    <button
                                        onclick="document.getElementById('edit{{ $building->id }}').classList.remove('hidden')"
                                        class="text-amber-600 hover:text-amber-800 font-semibold px-2">Edit</button>
                                    <form action="{{ route('buildings.destroy', $building->id) }}" method="POST"
                                        class="inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin menghapus?')"
                                            class="text-red-600 hover:text-red-800 font-semibold px-2">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div id="edit{{ $building->id }}"
                                class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm overflow-y-auto">
                                <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl transform transition-all">
                                    <!-- Header -->
                                    <div class="flex justify-between items-center p-6 border-b border-slate-100">
                                        <h3 class="text-lg font-bold text-slate-800">Edit Data Bangunan</h3>
                                        <button
                                            onclick="document.getElementById('edit{{ $building->id }}').classList.add('hidden')"
                                            class="text-slate-400 hover:text-slate-600 transition text-2xl font-bold">×</button>
                                    </div>

                                    <form action="{{ route('buildings.update', $building->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="p-6 space-y-4">
                                            <!-- Kode & Nama -->
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label
                                                        class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Kode
                                                        Bangunan</label>
                                                    <input type="text" name="kode_bangunan"
                                                        value="{{ old('kode_bangunan', $building->kode_bangunan) }}"
                                                        class="w-full border border-slate-200 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition">
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Nama
                                                        Bangunan</label>
                                                    <input type="text" name="nama_bangunan"
                                                        value="{{ old('nama_bangunan', $building->nama_bangunan) }}"
                                                        class="w-full border border-slate-200 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition">
                                                </div>
                                            </div>

                                            <!-- Selects -->
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label
                                                        class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Jenis
                                                        Bangunan</label>
                                                    <select name="jenis_bangunan"
                                                        class="w-full border border-slate-200 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition">
                                                        @foreach (['Asrama', 'Madrasah', 'Masjid', 'Kantor', 'Gedung Serba Guna'] as $opt)
                                                            <option value="{{ $opt }}"
                                                                {{ $building->jenis_bangunan == $opt ? 'selected' : '' }}>
                                                                {{ $opt }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Jenis
                                                        Konstruksi</label>
                                                    <select name="jenis_konstruksi"
                                                        class="w-full border border-slate-200 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition">
                                                        @foreach (['Gedek', 'Semi Permanen', 'Permanen', 'Permanen Bertingkat'] as $opt)
                                                            <option value="{{ $opt }}"
                                                                {{ $building->jenis_konstruksi == $opt ? 'selected' : '' }}>
                                                                {{ $opt }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Rayon & Tahun -->
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <label
                                                        class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Rayon</label>
                                                    <input type="text" name="rayon"
                                                        value="{{ old('rayon', $building->rayon) }}"
                                                        class="w-full border border-slate-200 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition">
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Tahun
                                                        Berdiri</label>
                                                    <input type="number" name="tahun_berdiri"
                                                        value="{{ old('tahun_berdiri', $building->tahun_berdiri) }}"
                                                        class="w-full border border-slate-200 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition">
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Luas
                                                    Bangunan (m²)</label>
                                                <input type="number" step="0.01" name="luas_bangunan"
                                                    value="{{ old('luas_bangunan', $building->luas_bangunan) }}"
                                                    class="w-full border border-slate-200 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition">
                                            </div>

                                            <div>
                                                <label
                                                    class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Alamat</label>
                                                <textarea name="alamat" rows="2"
                                                    class="w-full border border-slate-200 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition">{{ old('alamat', $building->alamat) }}</textarea>
                                            </div>
                                        </div>

                                        <!-- Footer -->
                                        <div class="px-6 py-4 bg-slate-50 rounded-b-2xl flex justify-end gap-3">
                                            <button type="button"
                                                onclick="document.getElementById('edit{{ $building->id }}').classList.add('hidden')"
                                                class="px-5 py-2.5 rounded-xl font-semibold text-sm text-slate-600 hover:bg-slate-200 transition">Batal</button>
                                            <button type="submit"
                                                class="px-5 py-2.5 rounded-xl font-semibold text-sm bg-emerald-600 text-white hover:bg-emerald-700 transition shadow-sm">Simpan
                                                Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="px-6 py-4 border-t border-slate-100">
                {{ $buildings->links() }}
            </div>

            <!-- Modal Tambah -->
            <div id="modalTambah"
                class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm overflow-y-auto">
                <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl transform transition-all">
                    <!-- Header -->
                    <div class="flex justify-between items-center p-6 border-b border-slate-100">
                        <h3 class="text-lg font-bold text-slate-800">Tambah Bangunan Baru</h3>
                        <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                            class="text-slate-400 hover:text-slate-600 transition text-2xl font-bold">×</button>
                    </div>

                    <form action="{{ route('buildings.store') }}" method="POST">
                        @csrf
                        <div class="p-6 space-y-4">
                            <!-- Row 1: Kode & Nama -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Kode
                                        Bangunan</label>
                                    <input type="text" name="kode_bangunan"
                                        class="w-full border border-slate-200 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition"
                                        required>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Nama
                                        Bangunan</label>
                                    <input type="text" name="nama_bangunan"
                                        class="w-full border border-slate-200 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition"
                                        required>
                                </div>
                            </div>

                            <!-- Row 2: Jenis Bangunan & Konstruksi -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Jenis
                                        Bangunan</label>
                                    <select name="jenis_bangunan"
                                        class="w-full border border-slate-200 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition"
                                        required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Masjid">Masjid</option>
                                        <option value="Madrasah">Madrasah</option>
                                        <option value="Asrama">Asrama</option>
                                        <option value="Kantor">Kantor</option>
                                        <option value="Gedung Serba Guna">Gedung Serba Guna</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Jenis
                                        Konstruksi</label>
                                    <select name="jenis_konstruksi"
                                        class="w-full border border-slate-200 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition"
                                        required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Gedek">Gedek</option>
                                        <option value="Semi Permanen">Semi Permanen</option>
                                        <option value="Permanen">Permanen</option>
                                        <option value="Permanen Bertingkat">Permanen Bertingkat</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Row 3: Rayon & Tahun -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Rayon</label>
                                    <input type="text" name="rayon"
                                        class="w-full border border-slate-200 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition"
                                        required>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Tahun
                                        Berdiri</label>
                                    <input type="number" name="tahun_berdiri"
                                        class="w-full border border-slate-200 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition"
                                        required>
                                </div>
                            </div>

                            <!-- Row 4: Luas & Alamat -->
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Luas Bangunan
                                    (m²)</label>
                                <input type="number" step="0.01" name="luas_bangunan"
                                    class="w-full border border-slate-200 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition"
                                    required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Alamat</label>
                                <textarea name="alamat" rows="2"
                                    class="w-full border border-slate-200 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition"
                                    required></textarea>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="px-6 py-4 bg-slate-50 rounded-b-2xl flex justify-end gap-3">
                            <button type="button"
                                onclick="document.getElementById('modalTambah').classList.add('hidden')"
                                class="px-5 py-2.5 rounded-xl font-semibold text-sm text-slate-600 hover:bg-slate-200 transition">Batal</button>
                            <button type="submit"
                                class="px-5 py-2.5 rounded-xl font-semibold text-sm bg-emerald-600 text-white hover:bg-emerald-700 transition shadow-sm">Simpan
                                Data</button>
                        </div>
                    </form>
                </div>
            </div>
        @endsection
