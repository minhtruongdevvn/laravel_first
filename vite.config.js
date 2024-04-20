import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/note.css',
            ],
            refresh: true,
        })
    ],
    build: {
        outDir: 'public/build', // Customize the output directory
    }
});
