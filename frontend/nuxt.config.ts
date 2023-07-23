// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  // プロキシの設定 (Laravel API)
  vite: {
    server: {
      proxy: {
        "/api/": {
          target: "http://web_attendance:80/api/",
          changeOrigin: true,
          rewrite: (path) => path.replace(/^\/api/, "")
        },
      },
    },
  }
})
