<template>
    <div class="mt-7 mx-auto text-center">
        <p class="mt-7 text-9xl font-bold">{{ error.statusCode }}</p>
        <p class="mt-7 text-3xl">{{ error.message }}</p>
        <button class="mt-7 px-3 button" @click="goToLogin()">Go to login page</button>
    </div>
</template>

<script setup>
 defineProps(['error']);
</script>

<script>
export default {
    methods: {
        goToLogin() {
            clearError({redirect: '/'});
        }
    }
}
</script>