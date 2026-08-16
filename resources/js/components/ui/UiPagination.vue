<script setup>
defineProps({
    currentPage: Number,
    lastPage: Number,
});

const emit = defineEmits(['change']);
</script>

<template>
    <div
        class="flex items-center justify-between gap-4 rounded-3xl border border-slate-200 bg-white px-4 py-3 shadow-sm">
        <p class="text-sm text-slate-500">
            Halaman {{ currentPage }} dari {{ lastPage }}
        </p>

        <div class="flex items-center gap-2">
            <button :disabled="currentPage <= 1" @click="emit('change', currentPage - 1)"
                class="rounded-xl border border-slate-200 px-3 py-2 text-sm text-slate-600 transition hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-50">
                Sebelumnya
            </button>

            <button :disabled="currentPage >= lastPage" @click="emit('change', currentPage + 1)"
                class="rounded-xl border border-slate-200 px-3 py-2 text-sm text-slate-600 transition hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-50">
                Berikutnya
            </button>
        </div>
    </div>
</template>