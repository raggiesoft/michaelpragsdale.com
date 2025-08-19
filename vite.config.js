import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/js/app.js',
                'resources/js/main.js',
            ],
            refresh: true,
        }),
    ],
    // --- ADD THIS ENTIRE 'build' SECTION ---
    build: {
        rollupOptions: {
            output: {
                // Use a function to conditionally set the filename.
                entryFileNames: (entryInfo) => {
                    // If the entry point is 'main.js', force the specific filename.
                    if (entryInfo.name === 'main') {
                        return 'assets/main-BNL55qkP.js';
                    }
                    // For all other entry points (like app.js), use the default naming.
                    return 'assets/[name]-[hash].js';
                },
                // Keep default naming for other files.
                chunkFileNames: `assets/[name]-[hash].js`,
                assetFileNames: `assets/[name]-[hash].[ext]`
            }
        }
    }
});
