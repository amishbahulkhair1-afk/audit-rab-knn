<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
  urlAction: {
    type: String,
    required: true
  },
  csrfToken: {
    type: String,
    required: true
  },
  materials: {
    type: Array,
    default: () => []
  },
  labors: {
    type: Array,
    default: () => []
  },
  equipments: {
    type: Array,
    default: () => []
  },
  supportCosts: {
    type: Array,
    default: () => []
  },
  dataLama: {
    type: Object,
    default: null
  },
  isEdit: {
    type: Boolean,
    default: false
  }
});

// State untuk form utama
const namaPekerjaan = ref('');
const satuan = ref('');
const detailItems = ref([]);
onMounted(() => {

  if (props.isEdit && props.dataLama) {

    namaPekerjaan.value = props.dataLama.nama_pekerjaan || '';
    satuan.value = props.dataLama.satuan || '';

    if (
      props.dataLama.details &&
      props.dataLama.details.length > 0
    ) {

      detailItems.value =
        props.dataLama.details.map(d => ({

          id: d.id || null,

          jenis: d.jenis || 'material',

          item_id: d.item_id || null,

          koefisien: d.koefisien || 0

        }));

    } else {

      tambahBaris();

    }

  } else {

    tambahBaris();

  }

});

// Fungsi menambah baris input baru
const tambahBaris = () => {
  detailItems.value.push({

    id: null,

    jenis: 'material',

    item_id: '',

    koefisien: 1

  });
};

// Fungsi menghapus baris input tertentu
const hapusBaris = (index) => {
  if (detailItems.value.length > 1) {
    detailItems.value.splice(index, 1);
  } else {
    alert('Minimal harus ada 1 item komponen.');
  }
};

const gantiJenis = (item) => {
  item.item_id = '';
};

</script>

<template>
  <form :action="urlAction" method="POST">
    <!-- Menyuntikkan token CSRF Laravel -->
    <input type="hidden" name="_token" :value="csrfToken">

    <!-- 3. PENTING: Menyuntikkan Method PUT jika dalam mode edit agar Laravel mengenalinya -->
    <input v-if="isEdit" type="hidden" name="_method" value="PUT">

    <!-- DATA UTAMA AHSP -->
    <div class="mb-4">
      <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pekerjaan <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span></label>
      <input type="text" name="nama_pekerjaan" v-model="namaPekerjaan"
        class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200" required>
    </div>

    <div class="mb-6">
      <label class="block text-sm font-medium text-gray-700 mb-1">Satuan <span class="text-rose-500 font-bold ml-0.5" title="Wajib diisi">*</span></label>
      <input type="text" name="satuan" v-model="satuan"
        class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200" placeholder="Contoh: m3, m2, m', kg"
        required>
    </div>

    <!-- PENGATURAN KELOMPOK DETAIL (DYNAMIC ITEMS) -->
    <div class="border-t pt-6 mb-6">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Rincian Komponen Analisis (Detail)</h3>
        <button type="button" @click="tambahBaris" class="bg-green-600 text-white px-3 py-1.5 rounded">
          Tambah Item
        </button>
      </div>

      <!-- Loop Baris Input Dinamis -->
      <div v-for="(item, index) in detailItems" :key="index"
        class="flex gap-4 items-end bg-gray-50 p-4 rounded-lg mb-3 border relative group">
        <!-- Simpan ID detail jika ada (hidden) -->
        <input type="hidden" :name="`details[${index}][id]`" :value="item.id">

        <!-- Pilihan Jenis -->
        <div class="w-1/4">
          <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase">Jenis</label>
          <select :name="`details[${index}][jenis]`" v-model="item.jenis" @change="gantiJenis(item)" class="w-full border rounded p-2 bg-white" required>
            <option value="material">
              Material
            </option>

            <option value="labor">
              Tenaga Kerja
            </option>

            <option value="equipment">
              Peralatan
            </option>

            <option value="support_cost">
              Biaya Pendukung
            </option>
          </select>
        </div>

        <!-- Nama Item Komponen -->
        <div class="flex-1">
          <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase">Nama Item Komponen</label>
          <select :name="`details[${index}][item_id]`" v-model="item.item_id" class="w-full border rounded p-2" required>


            <option value="">
              -- Pilih Item --
            </option>



            <option v-if="item.jenis === 'material'" v-for="m in props.materials" :key="`material-${m.id}`" :value="m.id">

              {{ m.nama_bahan }}

            </option>



            <option v-if="item.jenis === 'labor'" v-for="l in props.labors" :key="`labor-${l.id}`" :value="l.id">

              {{ l.nama_pekerja }}

            </option>



            <option v-if="item.jenis === 'equipment'" v-for="e in props.equipments" :key="`equipment-${e.id}`" :value="e.id">

              {{ e.nama_alat }}

            </option>



            <option v-if="item.jenis === 'support_cost'" v-for="s in props.supportCosts" :key="`support-cost-${s.id}`" :value="s.id">

              {{ s.nama_biaya }}

            </option>


          </select>
        </div>

        <!-- Nilai Koefisien -->
        <div class="w-1/4">
          <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase">Koefisien</label>
          <input type="number" min="0.0001" step="0.0001" :name="`details[${index}][koefisien]`" v-model.number="item.koefisien"
            class="w-full border rounded p-2 bg-white text-center font-mono" required>
        </div>

        <!-- Tombol Hapus Baris -->
        <div class="pb-1">
          <button type="button" @click="hapusBaris(index)"
            class="bg-red-100 text-red-600 hover:bg-red-600 hover:text-white p-2.5 rounded transition shadow-sm"
            title="Hapus baris ini">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-14v4M1 7h22" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- ACTION BUTTONS -->
    <div class="flex gap-3 justify-end border-t pt-4">
      <a href="/ahsps" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded transition">
        Batal
      </a>
      <button type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow transition font-semibold">
        {{ isEdit ? 'Simpan Perubahan' : 'Simpan AHSP' }}
      </button>
    </div>
  </form>
</template>
