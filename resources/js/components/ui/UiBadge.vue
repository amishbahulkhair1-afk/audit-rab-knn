<script setup>
const props = defineProps({
    variant: {
        type: String,
        default: 'default',
    },
});

const classes = {
    default: 'bg-slate-100 text-slate-700',
    success: 'bg-emerald-100 text-emerald-700',
    warning: 'bg-amber-100 text-amber-700',
    danger: 'bg-red-100 text-red-700',
    info: 'bg-blue-100 text-blue-700',
};
</script>

<template>
    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium"
        :class="classes[props.variant] || classes.default">
        <slot />
    </span>
</template>