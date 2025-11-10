import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { readdirSync, statSync } from 'fs';
import { join } from 'path';
import { resolve } from 'path';

const jsFiles = getJsFiles(resolve(__dirname, "resources/js"));

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 'resources/js/app.js',
                // 'resources/css/backend.css',
                // 'resources/js/backend.js',
                // 'resources/css/frontend.css',
                // 'resources/js/frontend.js',
                ...jsFiles,

            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});

function getJsFiles(dir) {
    let jsFiles = [];
    const entries = readdirSync(dir);

    for (const entry of entries) {
        const fullPath = join(dir, entry);
        if (statSync(fullPath).isDirectory()) {
            jsFiles = jsFiles.concat(getJsFiles(fullPath));
        } else if (fullPath.endsWith(".js")) {
            jsFiles.push(fullPath.replace(__dirname, "").replace(/\\/g, "/"));
        }
    }

    return jsFiles;
}
