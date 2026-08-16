<script setup>
defineProps({
    modelValue: String,
    rows: {
        type: Number,
        default: 4,
    },
    placeholder: String,
});

const emit = defineEmits(['update:modelValue']);
</script>

<template>
    <textarea :rows="rows" :value="modelValue" :placeholder="placeholder"
        @input="emit('update:modelValue', $event.target.value)"
        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-indigo-300 focus:ring-2 focus:ring-indigo-200/50 resize-none"></textarea>
</template>