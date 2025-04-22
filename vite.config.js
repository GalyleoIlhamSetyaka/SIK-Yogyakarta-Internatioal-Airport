import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],            
            build: {
                assetsInlineLimit: 0 // Nonaktifkan base64 inline untuk gambar
            },
            refresh: true,
        }),
    ],
});
