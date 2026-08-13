import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'; // <-- 1. Tambahkan baris ini

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(), // <-- 2. Tambahkan fungsi ini di dalam array plugins
    ],
    resolve: {
        alias: {
            // 3. Tambahkan alias ini agar Vue bisa mengenali komponen di dalam Blade
            'vue': 'vue/dist/vue.esm-bundler.js', 
        },
    },
});