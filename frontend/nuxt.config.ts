export default defineNuxtConfig({
  devtools: { enabled: true },
  css: ['~/styles.css'],
  modules: ["@nuxtjs/tailwindcss",
    "@pinia/nuxt"],
  runtimeConfig: {
    public: {
      apiUrl: process.env.API_URL,
      googleApiKey: process.env.GOOGLE_API_KEY
    }
  }
})