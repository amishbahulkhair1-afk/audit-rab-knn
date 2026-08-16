<script setup>
import { ref, computed } from 'vue';

// Menerima data awal dari Blade lewat props
const props = defineProps({
  dataAwal: {
    type: Array,
    required: true
  }
});

// State internal komponen
const searchQuery = ref('');
const filterJenis = ref('');

// Logika Filter & Pencarian
const filteredDetails = computed(() => {
  return props.dataAwal.filter(item => {
    const matchJenis = filterJenis.value === '' || item.jenis === filterJenis.value;
    
    const searchLower = searchQuery.value.toLowerCase();
    const matchSearch = searchQuery.value === '' ||
      (item.ahsp?.kode?.toLowerCase().includes(searchLower)) ||
      (item.ahsp?.nama_pekerjaan?.toLowerCase().includes(searchLower)) ||
      (item.nama_item?.toLowerCase().includes(searchLower));

    return matchJenis && matchSearch;
  });
});

// Warna Badge Jenis
const getJenisBadgeClass = (jenis) => {
  switch (jenis) {
    case 'material': return 'bg-blue-100 text-blue-800';
    case 'labor': return 'bg-amber-100 text-amber-800';
    case 'equipment': return 'bg-purple-100 text-purple-800';
    default: return 'bg-gray-100 text-gray-800';
  }
};

// Konfirmasi Hapus Data
const confirmDelete = (event) => {
  if (!confirm('Yakin ingin menghapus data detail AHSP ini?')) {
    event.preventDefault();
  }
};
</script>

<template>
  <div>
    <!-- AREA FILTER & PENCARIAN -->
    <div class="mb-4 flex flex-col sm:flex-row gap-4">
      <div class="flex-1">
        <input 
          v-model="searchQuery" 
          type="text" 
          placeholder="Cari berdasarkan kode, pekerjaan, atau nama item..." 
          class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200"
        >
      </div>
      <div class="w-full sm:w-48">
        <select 
          v-model="filterJenis" 
          class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200"
        >
          <option value="">Semua Jenis</option>
          <option value="material">Material</option>
          <option value="labor">Labor</option>
          <option value="equipment">Equipment</option>
          <option value="support_cost">Biaya Pendukung</option>
        </select>
      </div>
    </div>

    <!-- TABEL DATA -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
      <table class="min-w-full border">
        <thead class="bg-gray-100">
          <tr>
            <th class="border px-4 py-2 w-16">No</th>
            <th class="border px-4 py-2 text-left">Kode AHSP</th>
            <th class="border px-4 py-2 text-left">Pekerjaan</th>
            <th class="border px-4 py-2">Jenis</th>
            <th class="border px-4 py-2 text-left">Nama Item</th>
            <th class="border px-4 py-2">Koefisien</th>
            <th class="border px-4 py-2 w-48">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(detail, index) in filteredDetails" :key="detail.id" class="hover:bg-gray-50">
            <td class="border px-4 py-2 text-center">{{ index + 1 }}</td>
            <td class="border px-4 py-2 font-mono text-sm">{{ detail.ahsp?.kode }}</td>
            <td class="border px-4 py-2">{{ detail.ahsp?.nama_pekerjaan }}</td>
            <td class="border px-4 py-2 text-center">
              <span :class="getJenisBadgeClass(detail.jenis)" class="px-2 py-1 rounded text-xs font-semibold uppercase">
                {{ detail.jenis }}
              </span>
            </td>
            <td class="border px-4 py-2">{{ detail.nama_item }}</td>
            <td class="border px-4 py-2 text-center font-medium">{{ detail.koefisien }}</td>
            <td class="border px-4 py-2">
              <div class="flex gap-2 justify-center">
                <a :href="'/ahsp-details/' + detail.id" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm transition">
                  Detail
                </a>
                <a :href="'/ahsp-details/' + detail.id + '/edit'" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition">
                  Edit
                </a>
                <form :action="'/ahsp-details/' + detail.id" method="POST" @submit="confirmDelete">
                  <!-- Slot untuk CSRF Token & Method PUT/DELETE dari Laravel akan disuntikkan dari Blade -->
                  <slot name="form-tokens" :id="detail.id"></slot>
                  <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm transition">
                    Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
          <tr v-if="filteredDetails.length === 0">
            <td colspan="7" class="text-center py-8 text-gray-500">
              Tidak ada data detail AHSP yang cocok.
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>