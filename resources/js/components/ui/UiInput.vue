<script setup>
defineProps({
    modelValue: [String, Number],
    type: {
        type: String,
        default: 'text',
    },
    placeholder: String,
    disabled: Boolean,
});

const emit = defineEmits(['update:modelValue']);
</script>

<template>
    <input :type="type" :value="modelValue" :placeholder="placeholder" :disabled="disabled"
        @input="emit('update:modelValue', $event.target.value)"
        class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-indigo-300 focus:ring-2 focus:ring-indigo-200/50 disabled:bg-slate-100 disabled:text-slate-400" />
</template>