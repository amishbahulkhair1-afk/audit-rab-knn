<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';

const open = ref(false);
const dropdownRef = ref(null);

function toggle() {
    open.value = !open.value;
}

function close() {
    open.value = false;
}

function handleClickOutside(event) {
    if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
        close();
    }
}

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
});
</script>

<template>
    <div ref="dropdownRef" class="relative inline-block text-left">

        <div @click="toggle">
            <slot name="trigger" />
        </div>

        <transition enter-active-class="transition duration-150 ease-out"
            enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition duration-100 ease-in" leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <div v-if="open"
                class="absolute right-0 z-50 mt-2 w-56 origin-top-right rounded-2xl border border-slate-200 bg-white p-2 shadow-xl dark:border-slate-700 dark:bg-slate-800">
                <slot :close="close" />
            </div>
        </transition>

    </div>
</template>