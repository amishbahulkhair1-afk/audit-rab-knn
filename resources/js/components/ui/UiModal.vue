<script setup>
defineProps({
    show: Boolean,
    title: String,
});

const emit = defineEmits(['close']);
</script>

<template>
    <transition name="fade">
        <div v-if="show"
            class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 p-4 backdrop-blur-sm">
            <div class="w-full max-w-lg rounded-3xl bg-white p-6 shadow-2xl">
                <div class="mb-5 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-slate-900">
                        {{ title }}
                    </h3>

                    <button @click="emit('close')"
                        class="rounded-xl p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition">
                        ✕
                    </button>
                </div>

                <div class="text-sm text-slate-600">
                    <slot />
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <slot name="footer" />
                </div>
            </div>
        </div>
    </transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>