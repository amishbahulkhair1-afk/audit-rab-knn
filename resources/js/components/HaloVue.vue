<script setup>
import { ref } from 'vue'
const pesan = ref('Halo! Saya Vue yang jalan di dalam Laravel Blade!')
</script>

<template>
  <div class="p-4 bg-green-100 text-green-800 rounded-lg shadow-md my-4">
    {{ pesan }}
  </div>
</template>