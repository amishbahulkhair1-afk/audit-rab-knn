<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
    variant: {
        type: String,
        default: 'primary',
    },
    loading: Boolean,
});

const variants = {
    primary:
        'bg-gradient-to-r from-indigo-500 to-violet-500 text-white hover:opacity-90 shadow-lg shadow-indigo-500/25',
    secondary:
        'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50',
    danger:
        'bg-red-500 text-white hover:bg-red-600 shadow-lg shadow-red-500/20',
};
</script>

<template>
    <button :type="type" :disabled="loading" :class="[
        'inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-2xl font-medium transition-all duration-200 disabled:opacity-60 disabled:cursor-not-allowed',
        variants[variant],
    ]">
        <svg v-if="loading" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
        </svg>

        <slot />
    </button>
</template>