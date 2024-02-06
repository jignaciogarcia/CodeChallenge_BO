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
                },
                onRequestError() {
                    throw new Error("An unexpected error has occurred");
                },
                onResponseError({ response }) {
                    let errorText;
                    let handledErrorsStatus = [400, 404];

                    if(handledErrorsStatus.includes(response.status)) {
                        errorText = response._data.message;
                    }
                    else {
                        errorText = "An unexpected error has occurred";
                    }
                    throw new Error(errorText);
                }
            });
            localStorage.setItem('APIkey', key.token);
        }
    }
})