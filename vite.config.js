// import { defineConfig } from "vite";
// import { laravel } from "vite-plugin-laravel";
export default {
    build: {
        outDir: "public/build/",
        emptyOutDir: true,
        manifest: true,
        target: "es2018",
        rollupOptions: {
            input: "resources/scripts/main.js",
        },
    },
    plugins: [],
};
