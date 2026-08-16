<script setup>
defineProps({
    title: String,
    description: String,
});
</script>

<template>
    <div class="glass-surface rounded-3xl p-6">
        <div v-if="title || description" class="mb-5">
            <h3 v-if="title" class="text-lg font-semibold text-slate-900">
                {{ title }}
            </h3>

            <p v-if="description" class="mt-1 text-sm text-slate-500">
                {{ description }}
            </p>
        </div>

        <slot />
    </div>
</template>