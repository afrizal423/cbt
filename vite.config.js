import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import FullReload from 'vite-plugin-full-reload'; // <-- import

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
            'resources/js/siswa.js',
        ]),
        FullReload([ // <-- tambahkan plugin
            'resources/views/**',
            'routes/**'
        ])
    ],
    build: {
        rollupOptions: {
          external: [
            'alpinejs',
            'bootstrap'
          ]
        }
    }
});
