import { defineStore } from "pinia";
import { API_KEY_STORAGE_NAME } from "~/constants";

export const useAuthStore = defineStore('authStore', {
    actions: {
        async login(email, password) {
            const config = useRuntimeConfig();

            const key = await $fetch(config.public.apiUrl + 'login', {
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
            localStorage.setItem(API_KEY_STORAGE_NAME, key.token);
        }
    }
})