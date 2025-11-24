import { wayfinder } from '@laravel/vite-plugin-wayfinder';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.ts'],
            ssr: 'resources/js/ssr.ts',
            refresh: true,
        }),
        tailwindcss(),
        wayfinder({
            formVariants: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks: undefined,
            },
        },
        commonjsOptions: {
            include: [/node_modules/],
            transformMixedEsModules: true,
        },
    },
    optimizeDeps: {
        include: [
            'reka-ui',
            'class-variance-authority',
            'es-errors',
            'es-errors/type',
        ],
        esbuildOptions: {
            target: 'esnext',
        },
    },
    resolve: {
        dedupe: ['vue'],
    },
    ssr: {
        noExternal: ['reka-ui', 'class-variance-authority'],
    },
});
