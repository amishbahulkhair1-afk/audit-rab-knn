<template>
    <div class="relative inline-block text-left" ref="dropdown">
        <button @click="open = !open" type="button"
            class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white/80 border border-slate-200 text-slate-500 hover:text-indigo-600 hover:bg-white transition shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6h.01M12 12h.01M12 18h.01" />
            </svg>
        </button>

        <transition enter-active-class="transition duration-150 ease-out" enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100" leave-active-class="transition duration-100 ease-in"
            leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
            <div v-if="open"
                class="absolute right-0 z-50 mt-2 w-44 origin-top-right rounded-2xl bg-white border border-slate-200 shadow-xl overflow-hidden">
                <div class="py-1">
                    <slot />
                </div>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'

const open = ref(false)
const dropdown = ref(null)

const handleClickOutside = (event) => {
    if (dropdown.value && !dropdown.value.contains(event.target)) {
        open.value = false
    }
}

onMounted(() => {
    document.addEventListener('click', handleClickOutside)
})

onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside)
})
</script>