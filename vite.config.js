import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/welcome.css',
                'resources/css/auth.css',
                'resources/css/calculadora.css',
                'resources/css/noticias.css',
                'resources/css/retos-eventos.css',
                // Tus archivos JS (si los tienes)
            ],
            refresh: true,
        }),
    ],
});