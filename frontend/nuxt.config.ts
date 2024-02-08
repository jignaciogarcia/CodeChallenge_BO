export default defineNuxtConfig({
  devtools: { enabled: true },
  modules: ["@nuxtjs/tailwindcss",
    "@pinia/nuxt"],
  runtimeConfig: {
    public: {
      apiUrl: process.env.API_URL
    }
  }
})