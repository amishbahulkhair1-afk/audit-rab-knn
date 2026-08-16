<script setup>
import { onMounted, ref } from 'vue';
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';

const props = defineProps({
    modelValue: String,
    placeholder: {
        type: String,
        default: 'Pilih tanggal',
    },
});

const emit = defineEmits(['update:modelValue']);
const input = ref(null);

onMounted(() => {
    flatpickr(input.value, {
        dateFormat: 'Y-m-d',
        defaultDate: props.modelValue,
        onChange: (selectedDates, dateStr) => {
            emit('update:modelValue', dateStr);
        },
    });
});
</script>

<template>
    <div class="relative">
        <input ref="input" type="text" :placeholder="placeholder"
            class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-indigo-300 focus:ring-2 focus:ring-indigo-200/50" />
    </div>
</template>