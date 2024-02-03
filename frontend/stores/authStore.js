import { defineStore } from "pinia";

export const useAuthStore = defineStore('authStore', {
    actions: {
        async login(email, password) {
            const key = await $fetch('http://127.0.0.1:8000/api/login', {
                method: 'POST',
                body: {
                    "email": email,
                    "password": password
                },
                headers: {
                    'Accept': 'application/json'
                }
            });
            localStorage.setItem('APIkey', key.token);
        }
    }
})